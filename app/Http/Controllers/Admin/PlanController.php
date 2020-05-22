<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;

//use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index(Request $request)
    {
        $request->flash();

        $plans = $this->repository->latest()->paginate(2);

        return view("admin.pages.plans.index", compact("plans"));
    }

    public function create(Request $request)
    {

        return view("admin.pages.plans.create");
    }

    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());

        return redirect()->route("plans.index");
    }

    public function edit(Request $request, $url)
    {
        $request->flash();

        $plan = $this->repository->where("url", $url)->first();

        if (!$plan)
            return redirect()->back();


        return view("admin.pages.plans.edit", compact('plan'));
    }

    public function update(StoreUpdatePlan $request, $url)
    {

        $plan = $this->repository->where("url", $url)->first();


        if (!$plan)
            return redirect()->back();

        $plan->update([
            "name" => $request->name,
            "price" => $request->price,
            "url" => $request->url,
            "description" => $request->description
        ]);

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
