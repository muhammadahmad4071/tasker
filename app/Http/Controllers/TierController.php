<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use Illuminate\Http\Request;

class TierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $tiers = Tier::get();
        $route = 'tiers.index-user';
        if ($user->hasRole('Admin')) {
            $route = 'tiers.index';
        }

        return view($route, [
            'tiers' => $tiers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tiers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'badge' => 'required|max:5',
            'benefits' => 'required|string|max:5000',
            'days_threshold' => 'required|integer|min:0',
            'required_tasks' => 'required|integer|min:0',
        ]);

        $validated['default'] = !!$request?->default;

        Tier::create($validated);

        return redirect()->route('tiers.index');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tier $tier)
    {
        return view('tiers.edit', [
            'tier' => $tier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tier $tier)
    {
        $validated = $request->validate([
            'name' => 'required',
            'badge' => 'required|max:5',
            'benefits' => 'required|string|max:5000',
            'days_threshold' => 'required|integer|min:0',
            'required_tasks' => 'required|integer|min:0',
        ]);

        $validated['default'] = !!$request?->default;

        $tier->update($validated);

        return back()->with('status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tier $tier)
    {
        $tier->delete();
        return back();
    }
}
