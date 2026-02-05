<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'country',
        'city',
        'nearest_point',
        'salary_from',
        'salary_to',
        'currency',
        'deadline',
        'skills',
        'job_type',
        'experience_years',
        'degree_level',
        'tags',
        'status',
    ];

    protected $casts = [
        'skills' => 'array',
        'tags' => 'array',
        'deadline' => 'date',
        'salary_from' => 'decimal:2',
        'salary_to' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function savedByUsers()
    {
        return $this->hasMany(SavedJob::class);
    }

    public function calculateMatchScore(User $user)
    {
        $jobSkills = $this->skills ?? [];
        $jobTags = $this->tags ?? [];
        
        $userSkills = $user->skills ?? [];
        $userTags = $user->job_tags ?? [];

        if (empty($jobSkills) && empty($jobTags)) {
            return 100;
        }

        $skillMatches = 0;
        $tagMatches = 0;

        // Skills match (Weight: 70%)
        if (!empty($jobSkills)) {
            $matchedSkills = array_intersect(
                array_map('mb_strtolower', $jobSkills),
                array_map('mb_strtolower', $userSkills)
            );
            $skillMatches = (count($matchedSkills) / count($jobSkills)) * 70;
        } else {
            $skillMatches = 70; // If no skills required, give full weight to users
        }

        // Tags match (Weight: 30%)
        if (!empty($jobTags)) {
            $matchedTags = array_intersect(
                array_map('mb_strtolower', $jobTags),
                array_map('mb_strtolower', $userTags)
            );
            $tagMatches = (count($matchedTags) / count($jobTags)) * 30;
        } else {
            $tagMatches = 30; // If no tags required
        }

        $score = round($skillMatches + $tagMatches);
        
        // Ensure some baseline score if they have ANY skill from the job
        if ($score === 0 && (!empty(array_intersect(array_map('mb_strtolower', $jobSkills), array_map('mb_strtolower', $userSkills))) || !empty(array_intersect(array_map('mb_strtolower', $jobTags), array_map('mb_strtolower', $userTags))))) {
            $score = 10;
        }

        return min(100, $score);
    }
}
