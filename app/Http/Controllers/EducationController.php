<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EducationController extends Controller
{
    /**
     * Store a newly created education record in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $request->user()->education()->create($validated);

        return Redirect::back()->with('status', 'education-added');
    }

    /**
     * Remove the specified education record from storage.
     */
    public function destroy(Education $education): RedirectResponse
    {
        if (auth()->id() !== $education->user_id) {
            abort(403);
        }

        $education->delete();

        return Redirect::back()->with('status', 'education-deleted');
    }
}
