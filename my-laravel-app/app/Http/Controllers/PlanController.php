<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan; // ✅ Ensure the Plan model is imported

class PlanController extends Controller
{
    /**
     * ✅ Display all academic plans.
     * - Retrieves all plans from the database and passes them to the view.
     */
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * ✅ Show the form for creating a new plan.
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * ✅ Store a new academic plan in the database.
     * - Validates input data before creating a new plan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'PlanName'        => 'required|string|max:255',
            'RequiredCredits' => 'required|integer|min:1',
        ]);

        Plan::create([
            'PlanName'        => $request->PlanName,
            'RequiredCredits' => $request->RequiredCredits,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully!');
    }

    /**
     * ✅ Show the form for editing an existing academic plan.
     * - Ensures the requested plan exists before displaying the form.
     */
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * ✅ Update an existing academic plan in the database.
     * - Validates input before updating the plan details.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'PlanName'        => 'required|string|max:255',
            'RequiredCredits' => 'required|integer|min:1',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update([
            'PlanName'        => $request->PlanName,
            'RequiredCredits' => $request->RequiredCredits,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully!');
    }

    /**
     * ✅ Delete an academic plan from the database.
     * - Ensures the plan is deleted and redirects with a success message.
     */
    public function destroy($id)
    {
        Plan::destroy($id);
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully!');
    }
}

