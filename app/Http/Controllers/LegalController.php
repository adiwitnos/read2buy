<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class LegalController extends Controller
{
    /**
     * Display the official affiliate disclosure page.
     */
    public function affiliateDisclosure(): View
    {
        return view('legal.affiliate-disclosure');
    }

    /**
     * Display affiliate transparency page (Versi 2.2).
     */
    public function affiliateTransparency(): View
    {
        return view('legal.transparansi-afiliasi');
    }

    /**
     * Display The Read2Buy Standard curation methodology page.
     */
    public function curationStandard(): View
    {
        return view('showroom.standar-kurasi');
    }

    /**
     * Display the privacy policy page.
     */
    public function privacyPolicy(): View
    {
        return view('legal.privacy-policy');
    }

    /**
     * Display frequently asked questions (FAQ) for consumers and manufacturers.
     */
    public function faq(): View
    {
        return view('legal.faq');
    }

    /**
     * Display disclaimer page.
     */
    public function disclaimer(): View
    {
        return view('legal.disclaimer');
    }

    /**
     * Display editorial policy and integrity code.
     */
    public function editorialPolicy(): View
    {
        return view('legal.kebijakan-editorial');
    }

    /**
     * Display terms of service and conditions.
     */
    public function termsOfService(): View
    {
        return view('legal.syarat-ketentuan');
    }

    /**
     * Display contact and editorial communication page.
     */
    public function contact(): View
    {
        return view('legal.contact');
    }
}
