<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExperienceController extends Controller
{
    /**
     * Store a newly created experience in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
        ]);

        $request->user()->experiences()->create($validated);

        return Redirect::back()->with('status', 'experience-added');
    }

    /**
     * Remove the specified experience from storage.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        if (auth()->id() !== $experience->user_id) {
            abort(403);
        }

        $experience->delete();

        return Redirect::back()->with('status', 'experience-deleted');
    }
}
