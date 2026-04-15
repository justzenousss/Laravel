<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $items = collect(session('cart', []))->values();
        $subtotal = $items->sum(fn ($item) => $item['price'] * $item['quantity']);
        $total = $subtotal;

        return view('cart.index', compact('items', 'subtotal', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $quantityToAdd = $validated['quantity'] ?? 1;

        if ($product->quantity < 1) {
            return back()->with('error', 'Sản phẩm này hiện đã hết hàng.');
        }

        $cart = session('cart', []);
        $currentQuantity = $cart[$product->id]['quantity'] ?? 0;

        if ($currentQuantity >= $product->quantity) {
            return back()->with('error', 'Bạn đã thêm tối đa số lượng còn trong kho cho sản phẩm này.');
        }

        $newQuantity = min($currentQuantity + $quantityToAdd, $product->quantity);

        $cart[$product->id] = [
            'product_id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'price' => (float) $product->price,
            'quantity' => $newQuantity,
            'max_quantity' => (int) $product->quantity,
            'image_url' => $product->image_url,
        ];

        session(['cart' => $cart]);

        if ($newQuantity < ($currentQuantity + $quantityToAdd)) {
            return back()->with('success', 'Đã thêm vào giỏ hàng, nhưng số lượng được giới hạn theo tồn kho hiện có.');
        }

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    public function update(Request $request, int $productId): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session('cart', []);

        if (!isset($cart[$productId])) {
            return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        $product = Product::find($productId);

        if (!$product) {
            unset($cart[$productId]);
            session(['cart' => $cart]);

            return redirect()->route('cart.index')->with('error', 'Sản phẩm đã không còn tồn tại nên đã được xóa khỏi giỏ hàng.');
        }

        if ($product->quantity < 1) {
            unset($cart[$productId]);
            session(['cart' => $cart]);

            return redirect()->route('cart.index')->with('error', 'Sản phẩm đã hết hàng nên đã được xóa khỏi giỏ hàng.');
        }

        $newQuantity = min($validated['quantity'], $product->quantity);

        $cart[$productId]['quantity'] = $newQuantity;
        $cart[$productId]['max_quantity'] = (int) $product->quantity;
        $cart[$productId]['price'] = (float) $product->price;
        $cart[$productId]['image_url'] = $product->image_url;

        session(['cart' => $cart]);

        if ($newQuantity < $validated['quantity']) {
            return redirect()->route('cart.index')->with('success', 'Số lượng đã được điều chỉnh theo tồn kho hiện có.');
        }

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function destroy(int $productId): RedirectResponse
    {
        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }
}