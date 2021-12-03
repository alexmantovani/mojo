<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites() {
        return $this->belongsToMany(Issue::class);
    }

    public function voteIssues()
    {
        return $this->belongsToMany(Issue::class, 'vote_issue_pivot_table')
        ->withPivot('issue_id', 'user_id', 'vote')
        ->withTimestamps();
    }

    public function voteSolutions()
    {
        return $this->belongsToMany(Solution::class, 'vote_answer_pivot_table')
        ->withPivot('solution_id', 'user_id', 'vote')
        ->withTimestamps();
    }


}