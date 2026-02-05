<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function store(Request $request, JobListing $job)
    {
        if (Auth::user()->role !== 'candidate') {
            return back()->with('error', 'يجب أن تكون باحثاً عن عمل للتقديم على الوظائف.');
        }

        if ($job->status !== 'approved') {
            return back()->with('error', 'عذراً، هذه الوظيفة غير متاحة حالياً للتقديم.');
        }

        // Check if already applied
        $existing = JobApplication::where('user_id', Auth::id())
            ->where('job_listing_id', $job->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'لقد قمت بالتقديم على هذه الوظيفة مسبقاً.');
        }

        JobApplication::create([
            'user_id' => Auth::id(),
            'job_listing_id' => $job->id,
            'match_score' => $job->calculateMatchScore(Auth::user()),
            'status' => 'pending',
        ]);

        return back()->with('success', 'تم تقديم طلبك بنجاح! يمكنك متابعة حالة الطلب من لوحة التحكم.');
    }

    public function myApplications()
    {
        if (Auth::user()->role !== 'candidate') {
            abort(403);
        }

        $applications = JobApplication::where('user_id', Auth::id())
            ->with('jobListing.user')
            ->latest()
            ->get();

        return view('jobs.my-applications', compact('applications'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        // Authorize that the authenticated user is the employer who posted the job
        if (Auth::user()->role !== 'employer' || $application->jobListing->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        $message = $validated['status'] === 'accepted' ? 'تم قبول المتقدم بنجاح.' : 'تم رفض المتقدم.';
        
        return back()->with('success', $message);
    }
}
