<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = [];
        $user = auth()->user();
        if ($user->hasRole('Admin')) {
            $orders = Order::get();
        } else {
            $orders = $user->orders;
        }

        return view('orders.index', [
            'orders' => $orders
        ]);
    }


    public function create() {
        return view('orders.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'type' => 'required|in:subscribers,views',
            'amount' => 'required|integer|min:1|lte:'.$request->user()->points->value ?? 0,
            'url' => 'required|url'
        ]);


        $user = $request->user();

        $user->orders()->create($validated);

        $points = $user->points;
        $points->value -= $validated['amount'];
        $points->save();

        return redirect()->route('orders.index');
    }

    public function destroy(Request $request, Order $order) {
        $user = auth()->user();
        $isAdmin = $user->hasRole('Admin');
        if ($order->user_id === $user->id || $isAdmin) {
            if ($isAdmin) {
                $user = $order->user;
            }
            $points = $user->points;
            $points->value += $order->amount;
            $points->save();
            $order->delete();
            return back();
        }

        abort(403, "You can't delete this order");
    }
}
