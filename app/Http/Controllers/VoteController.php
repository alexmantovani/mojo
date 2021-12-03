<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
use Auth;

class VoteController extends Controller
{
    public function likeIssue(Issue $issue)
    {
        return Auth::user()->voteIssues()->sync([$issue->id => ['vote' => 1]]);
    }

    public function dislikeIssue(Issue $issue)
    {
        return Auth::user()->voteIssues()->sync([$issue->id => ['vote' => -1]]);
    }


    public function likeSolution($id)
    {
        return Auth::user()->voteSolutions()->sync([$id => ['vote' => 1]]);
    }

    public function dislikeSolution($id)
    {
        return Auth::user()->voteSolutions()->sync([$id => ['vote' => -1]]);
    }
}
