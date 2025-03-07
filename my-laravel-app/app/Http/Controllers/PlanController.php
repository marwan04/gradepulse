<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan; // ✅ تأكد من استيراد مودل Plan

class PlanController extends Controller
{
    /**
     * عرض جميع الخطط الدراسية
     */
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * عرض نموذج إنشاء خطة جديدة
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * تخزين خطة جديدة في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $request->validate([
            'PlanName' => 'required|string|max:255',
            'RequiredCredits' => 'required|integer|min:1',
        ]);

        Plan::create([
            'PlanName' => $request->PlanName,
            'RequiredCredits' => $request->RequiredCredits,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully!');
    }

    /**
     * عرض نموذج تعديل خطة دراسية
     */
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * تحديث بيانات الخطة الدراسية
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'PlanName' => 'required|string|max:255',
            'RequiredCredits' => 'required|integer|min:1',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update([
            'PlanName' => $request->PlanName,
            'RequiredCredits' => $request->RequiredCredits,
        ]);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully!');
    }

    /**
     * حذف الخطة الدراسية
     */
    public function destroy($id)
    {
        Plan::destroy($id);
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully!');
    }
}

