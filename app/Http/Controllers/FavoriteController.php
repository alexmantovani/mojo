<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
use Auth;

class FavoriteController extends Controller
{
    public function store(Issue $issue)
    {
        return Auth::user()->favorites()->toggle($issue);
    }
}
