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
use App\Models\Freebie; 
use App\Models\Transaction;
use App\Http\Controllers\CustomTCPDF; 
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
        
        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->customer_name = $request->name ?: null; // Assign null if name is empty
        $transaction->inn_id = $request->inn_id;
        $transaction->room_id = $request->room_id;
        $transaction->status = 1;
        $transaction->room_rate_id = $request->room_rate_id;
        
        if ($request->has('reservation_id')) {
            $transaction->reservation_id = $request->reservation_id ?? null;
        }
        
        $transaction->save();
        
        $room = Room::find($request->room_id);
        $room->status = 1;
        $room->save();
        
        return redirect()->back()->with('success', 'Added Successfully!');
        
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
