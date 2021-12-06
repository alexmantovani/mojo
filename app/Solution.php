<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = [
        'user_id', 'description'
    ];

    // public function attachments() {
    //     return $this->hasMany(AttachmentSolution::class);
    // }
    public function attachments()
    {
        return $this->morphMany('App\Attachment', 'attachable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function issues() {
        return $this->belongsToMany(Issues::class);
    }

    public function votes() {
        return $this->belongsToMany(Solution::class, 'vote_answer_pivot_table')
        ->withPivot('solution_id', 'user_id', 'vote')
        ->withTimestamps();
    }
}
