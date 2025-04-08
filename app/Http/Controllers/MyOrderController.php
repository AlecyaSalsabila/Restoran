<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index()
    {
        return view('myorders.index', [
            'orders' => Order::where('user_id', Auth::id())->get()
        ]);
    }

    public function create()
    {
        return view('myorders.create', [
            'menus' => Menu::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|array',
            'amount' => 'required|array',
            'amount.*' => 'integer|min:1',
        ]);
    
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda perlu masuk untuk membuat pesanan.');
        }
    
        $totalPrice = 0;
    
        foreach ($request->menu_id as $index => $menuId) {
            $menu = Menu::find($menuId);
            if (!$menu) {
                return redirect()->back()->withErrors(['menu_id' => 'Menu not found for ID: ' . $menuId]);
            }
            $totalPrice += $menu->price * $request->amount[$index];
        }
    
        $transactionId = 'trx/' . strtoupper(uniqid()) . '/' . now()->format('YmdHis');
    
     
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'progress',
            'transaction_id' => $transactionId, 
        ]);
    

        foreach ($request->menu_id as $index => $menuId) {
            $menu = Menu::find($menuId);
            if ($menu) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'amount' => $request->amount[$index],
                    'price' => $menu->price,
                ]);
                $menu->decrement('stock', $request->amount[$index]);
            }
        }
    
        return redirect()->route('myorders.index')->with('success', 'Pesanan berhasil dibuat!');
    }
    

    public function show($id)
    {
        $order = Order::with('items.menu')->where('id', $id)->where('user_id', Auth::id())->first();
        if (!$order) {
            return redirect()->route('myorders.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('myorders.show', ['order' => $order]);
    }
}

