<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = request()->search ?? '';

        $openIssues = Issue::doesntHave('Solutions')
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('home', compact('openIssues', 'search'));
    }
}
