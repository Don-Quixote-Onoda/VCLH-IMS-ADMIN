<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Inn;
use App\Models\Room;
use App\Models\Freebie;
use App\Models\InventoryManagement;
use App\Models\OrderDetail;
use App\Models\OrderSummary;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class AdminInnControllers extends Controller
{
    public function dashboard(string $id) {
        $order_summary = OrderSummary::where('inn_id', $id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $id)->where('is_deleted', 0)->get();

        $order_number = count($order_summary) > 0 ? 'vcw-'.$id.'-ams-'.$order_summary->last()->id+1 : 'vcw-9-ams-1';
        $order_details = OrderDetail::where('inn_id', $id)->where('order_number', $order_number)->where('is_deleted', 0)->get();
        $rooms = Room::where('inn_id', $id)->get();
        return view('admin.inns.show.dashboard')
        ->with('products', $products)
        ->with('rooms', $rooms)
        ->with('order_details', $order_details)
        ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id+1 : 1)
        ->with('id', $id);
    }

    public function rooms(string $id) {
        $inn = Inn::find($id);
        $rooms = Room::select('*')->where('inn_id', $id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();

        return view('admin.inns.show.rooms.index')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('reservations', $reservations)
        ->with('id', $id)
        ->with('rooms', $rooms);
    }

    public function transactions(string $id) {
        $inn = Inn::find($id);
        $rooms = Room::select('*')->where('inn_id', $id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();

        return view('admin.inns.show.transactions.index')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('reservations', $reservations)
        ->with('id', $id)
        ->with('rooms', $rooms);
    }

    public function reservations(string $id) {
        $inn = Inn::find($id);
        $rooms = Room::select('*')->where('inn_id', $id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();

        return view('admin.inns.show.reservations.index')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('reservations', $reservations)
        ->with('id', $id)
        ->with('rooms', $rooms);
    }

    public function products(string $id) {
        $inn = Inn::find($id);
        $categories = Category::where('inn_id', $id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $id)->where('is_deleted', 0)->get();
        return view('admin.inns.show.products.index')
        ->with('inn', $inn)
        ->with('products', $products)
        ->with('categories', $categories)
        ->with('id', $id);
    }

    public function store_products(Request $request) {
        $inn = Inn::find($request->id);
        $this->validate($request, [
            'product_name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'inn_id' => 'required',
        ]);


        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image');
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/inns/products', $filenameToStore);
            
        }
        else {
            $filenameToStore = 'noimage.jpg';
        }

        Product::create([
            'name' => $request->product_name,
            'image' => $filenameToStore,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'inn_id' => $request->inn_id,
            'is_deleted' => 0,
        ]);
        $categories = Category::where('inn_id', $request->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $request->id)->where('is_deleted', 0)->get();
        return redirect('/admin/inn/products/'.$request->id)
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('products', $products)
        ->with('id', $request->id);
    }

    public function edit_products(Request $request, string $inn_id, string $id) {
        $inn = Inn::find($inn_id);

        $categories = Category::where('inn_id', $inn_id)->where('is_deleted', 0)->get();
       
        $product = Product::find($id);
        return view('admin.inns.show.products.edit')
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('product', $product)
        ->with('id', $inn_id);
    }

    public function update_products(Request $request, string $id) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'inn_id' => 'required',
        ]);

        $product = Product::find($request->id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        $inn = Inn::find($id);
        $categories = Category::where('inn_id', $id)->get();

        return redirect('/admin/inn/products/'.$id)
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $id);
    }

    public function destroy_products(Request $request, string $inn_id, string $id) {
        $category = Category::find($request->id);
        $category->update([
            "is_deleted" => 1
        ]);
        $product = Product::find($id);
        $product->delete = 1;
        $product->save();
        $inn = Inn::find($inn_id);
        $products = Product::where('inn_id', $request->id)->where('is_deleted', 0)->get();

        return redirect('/admin/inn/product_categories/'.$inn_id)
        ->with('inn', $inn)
        ->with('products', $products)
        ->with('id', $inn_id);
    }

    // Categories Section
    public function product_categories(string $id) {

        $inn = Inn::find($id);
        $categories = Category::where('inn_id', $id)->where('is_deleted', 0)->get();

        return view('admin.inns.show.category.index')
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $id);
    }

    public function store_product_categories(Request $request, string $id) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $category = Category::create([
            "name" => $request->name,
            "description" => $request->description,
            'inn_id' => $id,
            "is_deleted" => 0
        ]);
        $inn = Inn::find($id);
        $categories = Category::where('inn_id', $id)->get();

        return view('admin.inns.show.category.index')
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $id);
    }

    public function edit_product_categories(Request $request, string $inn_id, string $id) {
        $inn = Inn::find($inn_id);
        $category = Category::find($id);

        return view('admin.inns.show.category.edit')
        ->with('inn', $inn)
        ->with('category', $category)
        ->with('id', $inn_id);
    }
    

    public function update_product_categories(Request $request, string $id) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $category = Category::find($request->id);
        $category->update([
            'name' => $request->name,
            "description" => $request->description,
        ]);
        $inn = Inn::find($id);
        $categories = Category::where('inn_id', $id)->get();

        return redirect('/admin/inn/product_categories/'.$id)
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $id);
    }

    public function destroy_product_categories(Request $request, string $inn_id, string $id) {
      
        $category = Category::find($request->id);
        $category->update([
            "is_deleted" => 1
        ]);
        $inn = Inn::find($inn_id);
        $categories = Category::where('inn_id', $inn_id)->where('is_deleted', 0)->get();

        return redirect('/admin/inn/product_categories/'.$inn_id)
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $inn_id);
    }


    public function order_summaries(string $id) {
        $inn = Inn::find($id);
        $rooms = Room::select('*')->where('inn_id', $id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();
        $order_summaries = OrderSummary::where('inn_id', $id)->get();

        return view('admin.inns.show.order_summary.index')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('reservations', $reservations)
        ->with('order_summaries', $order_summaries)
        ->with('id', $id)
        ->with('rooms', $rooms);
    }

    public function pay_order_summary(string $id) {
        $order_summary = OrderSummary::where('inn_id', $id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $id)->where('is_deleted', 0)->get();
        $order_number = count($order_summary) > 0 ? 'vcw-'.$id.'-ams-'.$order_summary->last()->id+1 : 'vcw-9-ams-1';
        $order_details = OrderDetail::where('inn_id', $id)->where('order_number', $order_number)->where('is_deleted', 0)->get();
        $total = 0;
        foreach($order_details as $order_detail)
            $total = $total + $order_detail->subtotal;
        $rooms = Room::where('inn_id', $id)->get();
        return view('admin.inns.show.order_summary.pay')
        ->with('products', $products)
        ->with('rooms', $rooms)
        ->with('total', $total)
        ->with('order_details', $order_details)
        ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id : 1)
        ->with('id', $id);
    }

    public function store_order_summary(Request $request) {
        OrderSummary::create([
            'total_amount' => $request->total,
            'payment' => $request->payment, 
            'change' => $request->change,
            'order_number' => $request->order_number,
            'room_id' => $request->room_id,
            'inn_id' => $request->inn_id,
            'is_deleted' => 0,
        ]);
        $order_summary = OrderSummary::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $order_details = OrderDetail::where('inn_id', $request->inn_id)->where('is_deleted', 0)->get();
        $total = 0;
        foreach($order_details as $order_detail)
            $total = $total + $order_detail->subtotal;
        $rooms = Room::where('inn_id', $request->inn_id)->get();
        return redirect('/admin/inn/dashboard/'.$request->inn_id)
        ->with('products', $products)
        ->with('rooms', $rooms)
        ->with('total', $total)
        ->with('order_details', $order_details)
        ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id+1 : 1)
        ->with('id', $request->inn_id);
    }

    public function order_details(string $id) {
        $inn = Inn::find($id);
        $rooms = Room::select('*')->where('inn_id', $id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();
        $order_details = OrderDetail::where('inn_id', $id)->get();

        return view('admin.inns.show.order_details.index')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('reservations', $reservations)
        ->with('order_details', $order_details)
        ->with('id', $id)
        ->with('rooms', $rooms);
    }

    public function store_order_details(Request $request) {
        
        $product = Product::find($request->product_id);
        OrderDetail::create([
            'order_number' => $request->order_number,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'subtotal' => $request->quantity * $product->price,
            'product_id' => $request->product_id, 
            'inn_id' => $request->id,
            'is_deleted' => 0
        ]);
        $order_summary = OrderSummary::where('inn_id', $request->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $request->id)->where('is_deleted', 0)->get();
        $order_details = OrderDetail::where('inn_id', $request->id)->where('is_deleted', 0)->get();
        $rooms = Room::where('inn_id', $request->id)->get();
        return redirect('/admin/inn/dashboard/'.$request->id)
        ->with('products', $products)
        ->with('rooms', $rooms)
        ->with('order_details', $order_details)
        ->with('last_id', count($order_summary) > 0 ? $order_summary->last()->id : 1)
        ->with('id', $request->id);
    }

    public function inventory_managements(string $id) {
        $inn = Inn::find($id);
        $rooms = Room::select('*')->where('inn_id', $id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();
        $inventories = InventoryManagement::where('inn_id', $id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $id)->where('is_deleted', 0)->get();
        return view('admin.inns.show.inventory_management.index')
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('inventories', $inventories)
        ->with('products', $products)
        ->with('id', $id)
        ->with('rooms', $rooms);
    }

    public function store_inventory_managements(Request $request) {
        $inn = Inn::find($request->id);
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
            'inn_id' => 'required',
        ]);

        $product = Product::find($request->product_id);

        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image');
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/inns/products', $filenameToStore);
            $product->image = $filenameToStore;
        }
        else {
            $filenameToStore = 'noimage.jpg';
        }
        $product->quantity = $request->quantity + $product->quantity;
        $product->save();
        InventoryManagement::create([
            'name' => $product->name,
            'image' => $filenameToStore,
            'quantity' => $request->quantity,
            'inn_id' => $request->inn_id,
            'is_deleted' => 0,
        ]);
        $categories = Category::where('inn_id', $request->id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $request->id)->where('is_deleted', 0)->get();
        return redirect('/admin/inn/inventory_managements/'.$request->id)
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('products', $products)
        ->with('id', $request->id);
    }

    public function edit_inventory_managements(Request $request, string $inn_id, string $id) {
        $inn = Inn::find($inn_id);

        $categories = Category::where('inn_id', $inn_id)->where('is_deleted', 0)->get();

        $inventory = InventoryManagement::find($id);
        $products = Product::where('inn_id', $inn_id)->where('is_deleted', 0)->get();
        $product = Product::find($id);
        return view('admin.inns.show.inventory_management.edit')
        ->with('inn', $inn)
        ->with('products', $products)
        ->with('categories', $categories)
        ->with('inventory', $inventory)
        ->with('id', $inn_id);
    }

    public function update_inventory_managements(Request $request, string $id) {
        return $request;
        $this->validate($request, [
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'inn_id' => 'required',
        ]);

        $product = Product::find($request->id);
        $product->update([
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        $inn = Inn::find($id);
        $categories = Category::where('inn_id', $id)->get();

        return redirect('/admin/inn/products/'.$id)
        ->with('inn', $inn)
        ->with('categories', $categories)
        ->with('id', $id);
    }

    public function destroy_inventory_managements(Request $request, string $inn_id, string $id) {
        $inn = Inn::find($inn_id);
        $inventory = InventoryManagement::find($id);
        $inventory->is_deleted = 1;
        $inventory->save();
        $rooms = Room::select('*')->where('inn_id', $inn_id)->get();
        $freebies = Freebie::all();
        $transactions = Transaction::all();
        $reservations = Reservation::all();
        $inventories = InventoryManagement::where('inn_id', $inn_id)->where('is_deleted', 0)->get();
        $products = Product::where('inn_id', $inn_id)->where('is_deleted', 0)->get();
        return redirect('/admin/inn/inventory_managements/'.$inn_id)
        ->with('inn', $inn)
        ->with('freebies', $freebies)
        ->with('transactions', $transactions)
        ->with('inventories', $inventories)
        ->with('products', $products)
        ->with('id', $id)
        ->with('rooms', $rooms);
    }


}
