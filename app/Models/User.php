<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'company_name',
        'password',
        'phone',
        'profile_photo_path',
        'cv_path',
        'bio',
        'skills',
        'job_tags',
        'birthday',
        'gender',
        'country',
        'city',
        'languages',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills' => 'array',
            'job_tags' => 'array',
            'languages' => 'array',
            'birthday' => 'date',
        ];
    }

    /**
     * Get the experiences for the user.
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Get the education records for the user.
     */
    public function education()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Get the job applications for the user.
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }

    public function hasSavedJob($jobListingId)
    {
        return $this->savedJobs()->where('job_listing_id', $jobListingId)->exists();
    }

    public function reviews()
    {
        return $this->hasMany(CompanyReview::class, 'company_id');
    }

    public function givenReviews()
    {
        return $this->hasMany(CompanyReview::class, 'user_id');
    }

    public function averageRating()
    {
        return $this->reviews()->where('status', 'approved')->avg('rating') ?: 0;
    }

    /**
     * AI Recommendation Engine
     * Finds jobs that match the user's skills and tags.
     */
    public function recommendedJobs()
    {
        if ($this->role !== 'candidate') {
            return collect();
        }

        $skills = $this->skills ?? [];
        $tags = $this->job_tags ?? [];

        if (empty($skills) && empty($tags)) {
            // Fallback: Show latest jobs if no profile info
            return JobListing::with('user')->latest()->limit(5)->get();
        }

        return JobListing::where(function ($query) use ($skills, $tags) {
            foreach ($skills as $skill) {
                $query->orWhereJsonContains('skills', $skill);
            }
            foreach ($tags as $tag) {
                $query->orWhereJsonContains('tags', $tag);
            }
        })
        ->whereDoesntHave('applications', function ($query) {
            $query->where('user_id', $this->id);
        })
        ->with('user')
        ->latest()
        ->limit(6)
        ->get();
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
