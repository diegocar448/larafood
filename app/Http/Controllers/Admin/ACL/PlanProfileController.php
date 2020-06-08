<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanProfileController extends Controller
{
    protected $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function profiles($idPlan)
    {

        if (!$plan = $this->plan->find($idPlan))
            return redirect()->back();

        $profiles = $plan->profiles()->paginate(2);


        return view("admin.pages.plans.profiles.profiles", compact("plan", "profiles"));
    }

    public function plans($idProfile)
    {



        if (!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        //dd($profiles);

        $plans = $profile->plans()->paginate(2);




        return view("admin.pages.profiles.plans.plans", compact("plans", "profile"));
    }

    public function profilesAvailable(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);

        if (!$plan)
            return redirect()->back();

        $filters = $request->except('_token');



        $profiles = $plan->profilesAvailable($request->filter);



        return view("admin.pages.plans.profiles.available", compact("plan", "profiles", "filters"));
    }


    public function attachProfilesPlan(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);

        if (!$plan)
            return redirect()->back();



        if (!$request->profiles || count($request->profiles) === 0) {
            return redirect()->back()->with("error", "Você precisa adicionar pelo menos 1 Plano");
        }


        $plan->profiles()->attach($request->profiles);

        return redirect()->route("plans.profiles", $plan->id);
    }

    public function detachProfilePlan(Request $request, $idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);



        if (!$plan || !$profile)
            return redirect()->back();


        $plan->profiles()->detach($profile);

        return redirect()->route("plans.profiles", $plan->id);
    }
}
