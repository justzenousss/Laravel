<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(): View|RedirectResponse
    {
        $items = collect(session('cart', []))->values();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống, bạn chưa thể đặt hàng.');
        }

        $subtotal = $items->sum(fn ($item) => $item['price'] * $item['quantity']);
        $shippingFee = 0;
        $total = $subtotal + $shippingFee;

        return view('orders.checkout', compact('items', 'subtotal', 'shippingFee', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = collect(session('cart', []));

        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống, không thể tạo đơn hàng.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'note' => ['nullable', 'string'],
        ], [
            'customer_name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập email.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'address.required' => 'Vui lòng nhập địa chỉ nhận hàng.',
        ]);

        $productIds = $cart->pluck('product_id')->all();

        $products = Product::whereIn('id', $productIds)
            ->lockForUpdate()
            ->get()
            ->keyBy('id');

        foreach ($cart as $item) {
            $product = $products->get($item['product_id']);

            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'Có sản phẩm trong giỏ không còn tồn tại. Vui lòng kiểm tra lại.');
            }

            if ($product->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with(
                    'error',
                    'Sản phẩm "' . $product->name . '" không đủ tồn kho. Vui lòng cập nhật lại giỏ hàng.'
                );
            }
        }

        $subtotal = $cart->sum(fn ($item) => $item['price'] * $item['quantity']);

        $order = DB::transaction(function () use ($validated, $cart, $products, $subtotal) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'note' => $validated['note'] ?? null,
                'total_price' => $subtotal,
                'status' => 'Chờ xác nhận',
            ]);

            foreach ($cart as $item) {
                $product = $products->get($item['product_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $product->decrement('quantity', $item['quantity']);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('orders.success', $order)->with('success', 'Đặt hàng thành công.');
    }

    public function success(Order $order): View
    {
        $order->load('items.product');

        return view('orders.success', compact('order'));
    }
}
