<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'candidate') {
            abort(403);
        }

        $savedJobs = SavedJob::where('user_id', Auth::id())
            ->with('jobListing.user')
            ->latest()
            ->get();

        return view('jobs.saved', compact('savedJobs'));
    }

    public function store(Request $request, JobListing $job)
    {
        if (Auth::user()->role !== 'candidate') {
            return back()->with('error', 'يجب أن تكون مديراً لحساب مرشح لحفظ الوظائف.');
        }

        SavedJob::firstOrCreate([
            'user_id' => Auth::id(),
            'job_listing_id' => $job->id,
        ]);

        return back()->with('success', 'تم حفظ الوظيفة في قائمتك.');
    }

    public function destroy(JobListing $job)
    {
        SavedJob::where('user_id', Auth::id())
            ->where('job_listing_id', $job->id)
            ->delete();

        return back()->with('success', 'تم إزالة الوظيفة من قائمتك.');
    }
}
