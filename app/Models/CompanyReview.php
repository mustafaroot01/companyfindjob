<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    protected $fillable = ['user_id', 'company_id', 'rating', 'comment', 'status', 'reply', 'reply_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
}
