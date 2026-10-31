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
        // Safe check for active offer and valid product link
        if (! $offer->is_active || empty($offer->affiliate_url)) {
            $fallbackUrl = $offer->product?->slug
                ? route('showroom.product', ['slug' => $offer->product->slug])
                : route('home');

            return redirect()->to($fallbackUrl)->with('error', 'This offer is currently not active.');
        }

        // Validate safe outbound scheme (prevent open redirect to javascript:, data:, or malformed schemas)
        $parsedUrl = parse_url($offer->affiliate_url);
        if (empty($parsedUrl['scheme']) || ! in_array(strtolower($parsedUrl['scheme']), ['http', 'https'], true) || empty($parsedUrl['host'])) {
            $fallbackUrl = $offer->product?->slug
                ? route('showroom.product', ['slug' => $offer->product->slug])
                : route('home');

            return redirect()->to($fallbackUrl)->with('error', 'Invalid merchant destination link.');
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
