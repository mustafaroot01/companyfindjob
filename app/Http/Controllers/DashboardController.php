<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $stats = [];
        $recentActivity = [];
        $recommendedJobs = collect();

        if ($user->role === 'employer') {
            // Employer Stats
            $stats = [
                'active_jobs' => JobListing::where('user_id', $user->id)->count(),
                'total_applicants' => JobApplication::whereHas('jobListing', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->count(),
                'pending_applications' => JobApplication::where('status', 'pending')
                    ->whereHas('jobListing', function($q) use ($user) {
                        $q->where('user_id', $user->id);
                    })->count(),
                'hired_count' => JobApplication::where('status', 'accepted')
                    ->whereHas('jobListing', function($q) use ($user) {
                        $q->where('user_id', $user->id);
                    })->count(),
            ];

            // Recent Applicants
            $recentActivity = JobApplication::with(['user', 'jobListing'])
                ->whereHas('jobListing', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->latest()
                ->take(5)
                ->get();

        } else {
            // Candidate Stats
            $stats = [
                'applied_jobs' => JobApplication::where('user_id', $user->id)->count(),
                'saved_jobs' => SavedJob::where('user_id', $user->id)->count(),
                'pending_responses' => JobApplication::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->count(),
                'interviews' => JobApplication::where('user_id', $user->id)
                    ->where('status', 'accepted') // In this simple flow, accepted means move forward
                    ->count(),
            ];

            // Recent Applications
            $recentActivity = JobApplication::with('jobListing.user')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            // AI Recommendations
            $recommendedJobs = $user->recommendedJobs();
        }

        return view('dashboard', compact('stats', 'recentActivity', 'recommendedJobs'));
    }
}
