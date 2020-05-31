<?php

namespace App\Http\Controllers\Admin;

use App\Models\DetailPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class DetailPlanController extends Controller
{

    protected $repository, $plan;


    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($urlPlan)
    {

        if (!$plan = $this->plan->where("url", $urlPlan)->first()) {
            return redirect()->back();
        }

        $details = $plan->details()->paginate(2);

        return view("admin.pages.plans.details.index", compact("plan", "details"));
    }

    public function create(Request $request, $urlPlan)
    {
        if (!$plan = $this->plan->where("url", $urlPlan)->first()) {
            return redirect()->back();
        }


        return view("admin.pages.plans.details.create", compact('plan'));
    }

    public function store(Request $request, $urlPlan)
    {

        if (!$plan = $this->plan->where("url", $urlPlan)->first()) {
            return redirect()->back();
        }

        /* $data = $request->all();
        $data['plan_id'] = $plan->id;
        $this->repository->create($data); */

        $plan->details()->create($request->all());


        return redirect()->route("details.plan.index", $plan->url);
    }



    public function edit(Request $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where("url", $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }


        return view("admin.pages.plans.details.edit", compact('plan', 'detail'));
    }


    public function update(Request $request, $urlPlan, $idDetail)
    {

        $plan = $this->plan->where("url", $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());




        return redirect()->route("details.plan.index", $plan->url);
    }
}
