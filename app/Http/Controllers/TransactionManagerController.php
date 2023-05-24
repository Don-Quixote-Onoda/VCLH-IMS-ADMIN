<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
Use PDF;
use TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inn;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\Product;
use App\Models\Freebie; 
use App\Models\Transaction;
use App\Http\Controllers\CustomTCPDF; 
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\OrderSummary;

class TransactionManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $inns = Inn::select('*')->where('user_id', $id)->get();
        $rooms = Room::select('*')->where('inn_id', $inns[0]->id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::where('inn_id', $inns[0]->id)->get();
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        return view('user.transactions.index')
        ->with('inns', $inns)
        ->with('rooms', $rooms)
        ->with('inn', $inn)
        ->with('transactions', $transactions)
        ->with('freebies', $freebies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'inn_id' => 'required',
            'room_id' => 'required',
            'room_rate_id' => 'required',
        ]);
        $inn = Inn::where('user_id', Auth::user()->id)->get();
        $order_summary = OrderSummary::where('inn_id', $inn[0]->id)->where('is_deleted', 0)->get();
        $order_number = count($order_summary) > 0 ? 'vcw-' . $inn[0]->id . '-ams-' . $order_summary->last()->id + 1 : 'vcw-'.$inn[0]->id.'-ams-1';

        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->customer_name = $request->name ?: ""; // Assign null if name is empty
        $transaction->inn_id = $request->inn_id;
        $transaction->room_id = $request->room_id;
        $transaction->status = 1;
        $transaction->pos_transaction_number =  $request->pos_transaction_number != null ? $request->pos_transaction_number :  null;
        $transaction->room_rate_id = $request->room_rate_id;
        $transaction->pos_transaction_number = $order_number;
            $transaction->reservation_id = $request->reservation_id != null ?? 34;
        
        $transaction->save();
        
        $room = Room::find($request->room_id);
        $room->status = 1;
        $room->save();
        
        return redirect('/user/dashboard');
        
    }

    
    
    public function printInvoice($id)
    {
       
            $transaction = Transaction::findOrFail($id);

            // Render the invoice content to HTML with the transaction data
            $html = View::make('user.transactions.print', compact('transaction'))->render();

            // Create a new Dompdf instance
            $dompdf = new Dompdf();

            // Load the HTML content into Dompdf
            $dompdf->loadHtml($html);

            // Set paper size and orientation (optional)
            $dompdf->setPaper('A4', 'portrait');

            // Render the PDF
            $dompdf->render();

            // Generate a unique filename for the PDF
            $filename = 'invoice_' . $transaction->id . '.pdf';

            // Get the PDF content
            $pdfContent = $dompdf->output();

            // Store the PDF content to a temporary file
            $tempFilePath = storage_path('app/temp/' . $filename);
            file_put_contents($tempFilePath, $pdfContent);

            // Generate the URL to the temporary file
            $fileUrl = Storage::url('temp/' . $filename);

            // Return the response with the PDF file for preview
            return response()->file($tempFilePath, [
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
                'target' => '_blank',
            ]);

        
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      
    }

    public function showPosView($id)
    {
        $transaction = Transaction::find($id);
         $products = Product::all();

         return view('user.transactions.pos')
         ->with('transaction', $transaction)
         ->with('products', $products);
         }

         public function addToTransaction(Request $request, $id)
         {
             // Retrieve the transaction and product
             $transaction = Transaction::find($id);
             $productId = $request->input('product');
             $product = Product::find($productId);
         
             if ($transaction && $product) {
                 // Retrieve the selected products from the session
                 $selectedProducts = session('selectedProducts', []);
         
                 // Add the new product to the selected products array
                 $selectedProducts[] = [
                     'name' => $product->name,
                     'quantity' => $request->input('quantity'),
                     'price' => $product->price,
                 ];
         
                 // Calculate the total price
                 $totalPrice = session('totalPrice', $transaction->room_rate->rate);
                 $totalPrice += $product->price * $request->input('quantity');
         
                 // Store the updated selected products and total price in the session
                 session(['selectedProducts' => $selectedProducts]);
                 session(['totalPrice' => $totalPrice]);
         
                 return redirect()->back()->with('success', 'Product added to selected products successfully!');
             } else {
                 return redirect()->back()->with('error', 'Failed to add product to selected products.');
             }
         }
         
         

         
         public function processCheckout(Request $request, $id)
         {
             // Retrieve the transaction with the given ID
             $transaction = Transaction::findOrFail($id);
         
             // Retrieve the payment input from the request
             $paymentInput = $request->input('paymentInput');
         
             // Calculate the total amount
             $totalAmount = session('totalPrice', $transaction->room_rate->rate);
         
             // Calculate the change
             $change = $paymentInput - $totalAmount;
         
             // Update the transaction status
             $transaction->status = 'completed';
             $transaction->save();
         
             // Store the payment details
             $transaction->payment()->create([
                 'amount' => $totalAmount,
                 'payment_input' => $paymentInput,
                 'change' => $change,
             ]);

             $transaction->delete();
         
             // Generate the PDF
             $pdf = $this->generatePDF($transaction, $totalAmount, $paymentInput, $change);

            // Clear the session data
            $request->session()->forget(['totalPrice', 'selectedProducts']);

             // Return the PDF as a response
             return $pdf->stream('checkout.pdf');
         }

         private function generatePDF($transaction, $totalAmount, $paymentInput, $change)
        {
            // Create a new Dompdf instance
            $dompdf = new Dompdf();

            // Set options for the PDF generation (if needed)
            
            // Set any options you require, such as font paths, etc.
            // $options->set...

            // Assign the options to the Dompdf instance

            // Prepare the data for the PDF
            $data = [
                'transaction' => $transaction,
                'totalAmount' => $totalAmount,
                'paymentInput' => $paymentInput,
                'change' => $change,
            ];

            // Render the view to HTML
            $html = view('pdf.checkout', $data)->render();

            // Load the HTML into Dompdf
            $dompdf->loadHtml($html);

            // Set the paper size and orientation (optional)
            $dompdf->setPaper('A4', 'portrait');

            // Render the PDF
            $dompdf->render();

            // Return the generated PDF
            return $dompdf;
        }
         
         
         


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
