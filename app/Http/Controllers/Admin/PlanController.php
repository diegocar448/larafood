<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index(Request $request)
    {

        $plans = $this->repository->latest()->paginate(2);

        return view("admin.pages.plans.index", compact("plans"));
    }

    public function create(Request $request)
    {

        return view("admin.pages.plans.create");
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data["url"] = Str::kebab($request->name);
        $this->repository->create($data);


        return redirect()->route("plans.index");
    }

    public function show($url)
    {

        $plan = $this->repository->where("url", $url)->first();

        if (!$plan)
            return redirect()->back();


        return view("admin.pages.plans.show", compact('plan'));
    }

    public function destroy($url)
    {

        $plan = $this->repository->where("url", $url)->first();

        if (!$plan)
            return redirect()->back();

        $plan->delete();

        return redirect()->route("plans.index");
    }

    public function search(Request $request)
    {
        $request->flash();

        $filters = $request->except('_token');

        $plans = $this->repository->search($request->filter);

        //return view("admin.pages.plans.index", compact("plans", "filters"));
        return view("admin.pages.plans.index", [
            "plans" => $plans,
            "filters" => $filters,
        ]);
    }
}
