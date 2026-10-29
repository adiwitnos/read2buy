<?php

namespace App\Http\Controllers;

use App\Models\AffiliateOffer;
use App\Models\OutboundClick;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AffiliateRedirectController extends Controller
{
    /**
     * Handle safe outbound click tracking and redirect to marketplace offer.
     */
    public function redirect(Request $request, AffiliateOffer $offer): RedirectResponse
    {
        if (! $offer->is_active) {
            return redirect()->route('showroom.product', [
                'slug' => $offer->product->slug,
            ])->with('error', 'Penawaran ini saat ini sedang tidak aktif.');
        }

        // Record analytical outbound click event
        OutboundClick::create([
            'affiliate_offer_id' => $offer->id,
            'product_id' => $offer->product_id,
            'platform' => $offer->platform,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'referrer' => substr((string) $request->header('referer'), 0, 500),
        ]);

        return redirect()->away($offer->affiliate_url, 302, [
            'X-Robots-Tag' => 'noindex, nofollow',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
        ]);
    }
}
