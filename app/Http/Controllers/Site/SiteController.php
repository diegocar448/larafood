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
}
