<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBookmark;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Toggle bookmark state for a curated product.
     */
    public function toggle(Request $request, Product $product): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $existing = ProductBookmark::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = "Produk {$product->name} berhasil dihapus dari bookmark.";
        } else {
            ProductBookmark::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'notes' => $request->input('notes'),
            ]);
            $message = "Produk {$product->name} berhasil disimpan ke bookmark Anda.";
        }

        return back()->with('status', $message);
    }

    /**
     * Remove a bookmark item directly from dashboard.
     */
    public function destroy(ProductBookmark $bookmark): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($bookmark->user_id !== $user->id) {
            abort(403, 'Akses tidak sah ke bookmark ini.');
        }

        $productName = $bookmark->product?->name ?? 'Produk';
        $bookmark->delete();

        return redirect()->route('dashboard')->with('status', "Bookmark {$productName} berhasil dihapus.");
    }
}
