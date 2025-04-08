<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with(['user', 'menus'])->get();
        return view('orders.index', ['orders' => $orders]);
    }

    public function show($id){
        $order = Order::with(['user', 'menus'])->findOrFail($id);
        return view('orders.show', ['order' => $order]);
    }

    public function confirmOrder(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:confirmed,completed', 
        ]);
    
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Order status successfully updated.');
    }
    
    public function store(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id','menu_ids' => 'required|array','menu_ids.*' => 'exists:menus,id','status' => 'required|string',]);
        $order = Order::create(['user_id' => $request->user_id,'status' => $request->status,]);
        $order->menus()->attach($request->menu_ids);
        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat.');
    }
}
