<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\CompanyReview;

use App\Traits\LogsActivity;

class AdminController extends Controller
{
    use LogsActivity;
    
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_jobs' => JobListing::count(),
            'pending_jobs' => JobListing::where('status', 'pending')->count(),
            'total_applications' => JobApplication::count(),
            'total_reviews' => CompanyReview::count(),
            'pending_reviews' => CompanyReview::where('status', 'pending')->count(),
            'recent_users' => User::latest()->limit(5)->get(),
            'recent_jobs' => JobListing::with('user')->latest()->limit(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users(Request $request)
    {
        $query = User::latest();

        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }

        $users = $query->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function jobs(Request $request)
    {
        $query = JobListing::with('user')->withCount('applications')->latest();

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%')
                  ->orWhereHas('user', function($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->q . '%')
                        ->orWhere('company_name', 'like', '%' . $request->q . '%');
                  });
        }

        $jobs = $query->paginate(20);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function reviews()
    {
        $reviews = CompanyReview::with(['user', 'company'])->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function deleteUser(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'لا يمكن حذف حساب المسؤول.');
        }
        
        $this->logActivity('delete_user', "قام بحذف المستخدم: {$user->name} ({$user->email})", ['user_id' => $user->id]);
        
        $user->delete();
        return back()->with('success', 'تم حذف المستخدم بنجاح.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // ... validation ...
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        $oldData = $user->only(['name', 'email']);
        
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $user->save();
        
        $this->logActivity('update_user', "تحديث بيانات المستخدم: {$user->name}", [
            'old' => $oldData,
            'new' => $user->only(['name', 'email'])
        ]);

        return redirect()->route('admin.users')->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }

    public function deleteJob(JobListing $job)
    {
        $this->logActivity('delete_job', "حذف الوظيفة: {$job->title}", ['job_id' => $job->id]);
        $job->delete();
        return back()->with('success', 'تم حذف الوظيفة بنجاح.');
    }

    public function toggleReviewStatus(CompanyReview $review)
    {
        $review->status = $review->status === 'approved' ? 'pending' : 'approved';
        $review->save();

        $action = $review->status === 'approved' ? 'approved_review' : 'unapproved_review';
        $this->logActivity($action, "تغيير حالة مراجعة للمستخدم: {$review->user->name}");

        return back()->with('success', 'تم تحديث حالة المراجعة بنجاح.');
    }

    public function toggleJobStatus(JobListing $job)
    {
        $job->status = $job->status === 'approved' ? 'pending' : 'approved';
        $job->save();

        $action = $job->status === 'approved' ? 'approved_job' : 'unapproved_job';
        $this->logActivity($action, "تغيير حالة الوظيفة: {$job->title}");

        return back()->with('success', 'تم تحديث حالة الوظيفة بنجاح.');
    }
}
