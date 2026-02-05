<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\JobListing;
use App\Models\User;

class WelcomeController extends Controller
{
    /**
     * Show the application welcome screen.
     */
    public function index(): View
    {
        $featured_jobs = JobListing::where('status', 'approved')->with('user')->latest()->limit(6)->get();
        
        $stats = [
            'candidates' => User::where('role', 'candidate')->count(),
            'employers' => User::where('role', 'employer')->count(),
            'jobs' => JobListing::where('status', 'approved')->count(),
        ];

        // Grouping jobs by some popular tags for the categories section
        $categories = [
            ['name' => 'تطوير البرمجيات', 'icon' => 'code', 'tag' => 'Software'],
            ['name' => 'التصميم الإبداعي', 'icon' => 'paint', 'tag' => 'Design'],
            ['name' => 'المبيعات والتسويق', 'icon' => 'marketing', 'tag' => 'Marketing'],
            ['name' => 'الإدارة والمالية', 'icon' => 'finance', 'tag' => 'Finance'],
        ];

        foreach ($categories as &$category) {
            $category['count'] = JobListing::where('status', 'approved')
                ->where(function($query) use ($category) {
                    $query->where('tags', 'like', '%' . $category['tag'] . '%')
                          ->orWhere('title', 'like', '%' . $category['name'] . '%');
                })
                ->count();
        }

        return view('welcome', compact('featured_jobs', 'stats', 'categories'));
    }
}
