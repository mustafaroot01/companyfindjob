<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role === 'employer') {
            $jobs = JobListing::where('user_id', Auth::id())
                ->withCount('applications')
                ->latest()
                ->get();
            return view('jobs.index', compact('jobs'));
        }

        // Candidates see all jobs (Search page)
        return $this->search($request);
    }

    public function search(Request $request)
    {
        $query = JobListing::where('status', 'approved');

        // Title/Description Search
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('city', 'like', "%{$searchTerm}%")
                  ->orWhere('country', 'like', "%{$searchTerm}%");
            });
        }

        // Job Type Filter
        if ($request->filled('types')) {
            $query->whereIn('job_type', $request->types);
        }

        // City Filter
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Salary Range Filter
        if ($request->filled('salary_min')) {
            $query->where('salary_to', '>=', $request->salary_min);
        }
        if ($request->filled('salary_max')) {
            $query->where('salary_from', '<=', $request->salary_max);
        }

        // Experience Filter
        if ($request->filled('exp_min')) {
            $query->where('experience_years', '>=', $request->exp_min);
        }
        if ($request->filled('exp_max')) {
            $query->where('experience_years', '<=', $request->exp_max);
        }

        $jobs = $query->with('user')->latest()->get();
        
        // Get unique cities for filter dropdown
        $cities = JobListing::distinct()->pluck('city');
        
        return view('jobs.search', compact('jobs', 'cities'));
    }

    public function show(JobListing $job)
    {
        // Check if job is approved or if current user is owner/admin
        if ($job->status !== 'approved') {
            if (!Auth::check() || (Auth::id() !== $job->user_id && Auth::user()->role !== 'admin')) {
                abort(404, 'هذه الوظيفة لم يتم الموافقة عليها بعد أو تم سحبها.');
            }
        }

        $job->load('user');
        
        // Increment views if it's a candidate or guest (not the owner)
        if (!Auth::check() || Auth::user()->role === 'candidate') {
            $job->increment('views');
        }
        
        $hasApplied = false;
        if (Auth::check() && Auth::user()->role === 'candidate') {
            $hasApplied = $job->applications()->where('user_id', Auth::id())->exists();
        }

        return view('jobs.show', compact('job', 'hasApplied'));
    }

    public function applicants(JobListing $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        $applicants = $job->applications()
            ->with(['user.experiences', 'user.education'])
            ->orderBy('match_score', 'desc')
            ->latest()
            ->get();
        return view('jobs.applicants', compact('job', 'applicants'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'employer') {
            abort(403);
        }
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'employer') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'nearest_point' => 'nullable|string|max:255',
            'salary_from' => 'nullable|numeric',
            'salary_to' => 'nullable|numeric',
            'currency' => 'required|in:USD,IQD',
            'deadline' => 'nullable|date',
            'skills' => 'nullable|array',
            'job_type' => 'required|in:full-time,part-time,freelance',
            'experience_years' => 'required|integer|min:0',
            'degree_level' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
        ]);

        $validated['user_id'] = Auth::id();

        JobListing::create($validated);

        return redirect()->route('jobs.index')->with('success', 'تم إضافة الوظيفة بنجاح.');
    }

    public function edit(JobListing $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'nearest_point' => 'nullable|string|max:255',
            'salary_from' => 'nullable|numeric',
            'salary_to' => 'nullable|numeric',
            'currency' => 'required|in:USD,IQD',
            'deadline' => 'nullable|date',
            'skills' => 'nullable|array',
            'job_type' => 'required|in:full-time,part-time,freelance',
            'experience_years' => 'required|integer|min:0',
            'degree_level' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'تم تحديث الوظيفة بنجاح.');
    }

    public function destroy(JobListing $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'تم حذف الوظيفة بنجاح.');
    }

    public function employerProfile(\App\Models\User $user)
    {
        if ($user->role !== 'employer') {
            abort(404);
        }

        $jobs = $user->jobListings()->where('status', 'approved')->latest()->get();
        $reviews = $user->reviews()->with('user')->where('status', 'approved')->latest()->get();
        
        return view('jobs.employer-profile', compact('user', 'jobs', 'reviews'));
    }

    public function analytics()
    {
        if (Auth::user()->role !== 'employer') {
            abort(403);
        }

        $jobs = JobListing::where('user_id', Auth::id())
            ->withCount('applications')
            ->get();

        $totalViews = $jobs->sum('views');
        $totalApplications = $jobs->sum('applications_count');
        
        $conversionRate = $totalViews > 0 ? round(($totalApplications / $totalViews) * 100, 1) : 0;

        // Calculate average match score for all applications to these jobs
        $jobIds = $jobs->pluck('id');
        $applications = \App\Models\JobApplication::whereIn('job_listing_id', $jobIds)->get();
        
        // Use the model's calculateMatchScore logic for better accuracy if they were submitted before the update
        // but for now, we'll average what's in the DB
        $avgQuality = $applications->avg('match_score') ?? 0;

        return view('jobs.analytics', compact('jobs', 'totalViews', 'totalApplications', 'conversionRate', 'avgQuality'));
    }
}
