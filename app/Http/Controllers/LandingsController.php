<?php

namespace App\Http\Controllers;

use App\DTO\SeoTags;
use Illuminate\View\View;

class LandingsController extends Controller
{
    public function aboutUs(): View
    {
        return view('pages.about-us', [
            'seotags' => new SeoTags('about_us'),
        ]);
    }

    public function privacyPolicy(): View
    {
        return view('pages.privacy-policy', [
            'seotags' => new SeoTags('privacy_policy'),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'seotags' => new SeoTags('contact'),
        ]);
    }
}
