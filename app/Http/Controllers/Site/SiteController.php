<?php

namespace App\Http\Controllers\Site;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index(Request $request)
    {

        $plans = Plan::with('details')->orderBy("plans.price", "ASC")->get();

        return view("site.pages.home.index", compact('plans'));
    }

    public function plan($url)
    {
        if (!$plan = Plan::where("url", $url)->first()) {
            return redirect()->back();
        }

        session()->put('plan', $plan);

        return redirect()->route('register');
    }
}
