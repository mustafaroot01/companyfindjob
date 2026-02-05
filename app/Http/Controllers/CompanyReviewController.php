<?php

namespace App\Http\Controllers;

use App\Models\CompanyReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyReviewController extends Controller
{
    public function store(Request $request, User $company)
    {
        if (Auth::user()->role !== 'candidate') {
            return back()->with('error', 'يجب أن تكون باحثاً عن عمل لترك تقييم.');
        }

        if ($company->role !== 'employer') {
            abort(404);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Check if already reviewed
        $existing = CompanyReview::where('user_id', Auth::id())
            ->where('company_id', $company->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'لقد قمت بتقييم هذه الشركة مسبقاً.');
        }

        CompanyReview::create([
            'user_id' => Auth::id(),
            'company_id' => $company->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'approved', // Auto-approve for this demo
        ]);

        return back()->with('success', 'شكراً لك! تم إضافة تقييمك بنجاح.');
    }

    public function reply(Request $request, CompanyReview $review)
    {
        if (Auth::id() !== $review->company_id) {
            abort(403, 'غير مسموح لك بالرد على هذا التقييم.');
        }

        $validated = $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $review->update([
            'reply' => $validated['reply'],
            'reply_at' => now(),
        ]);

        return back()->with('success', 'تم إضافة ردك بنجاح.');
    }
}
