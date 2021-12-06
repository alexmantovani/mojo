<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'views',
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function attachments()
    {
        return $this->morphMany('App\Attachment', 'attachable');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function solutions() {
        return $this->belongsToMany(Solution::class);
    }

    public function favorites() {
        return $this->belongsToMany(User::class);
    }

    public function voteIssues()
    {
        return $this->belongsToMany(User::class, 'vote_issue_pivot_table')
        ->withPivot('issue_id', 'user_id', 'vote')
        ->withTimestamps();
    }

    public function voteSolutions()
    {
        return $this->belongsToMany(User::class, 'vote_answer_pivot_table')
        ->withPivot('solution_id', 'user_id', 'vote')
        ->withTimestamps();
    }

    public function hasSolutions()
    {
        if ( $this->solutions()->count() > 0 ) {
            return true;
        }

        return false;
    }

}
