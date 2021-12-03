<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solution;
use App\Issue;
use Auth;
use App\AttachmentSolution;
use Illuminate\Support\Str;

class SolutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $issue = Issue::findOrFail( request('issue') )->first();

        return view('solutions.create', compact( 'issue' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $issue = Issue::findOrFail( request('issue') );

        $solution = Solution::create([
            'description' => request('description'),
            'user_id' => Auth::user()->id,
        ]);

        $issue->solutions()->attach($solution->id);

        // Salvo gli allegati
        $files = $request->file('attachment');

        if ( $files != NULL ) {
    //    if ($request->hasFile('attachment')) {
            foreach ($files as $file) {
                $filename = Str::random(32);

                // Salvo l'immagine
                //$imagePath = $file->store('uploads', 'public');
                $path = $file->storeAs('uploads', $filename, 'public');
                $attachment = AttachmentSolution::create([
                    'file_name' => $filename,
                    'solution_id' => $solution->id,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        // return view('/home');
        return redirect()->action([HomeController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function show(Solution $solution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function edit(Solution $solution)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solution $solution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solution = Solution::findOrFail( $id );
        $solution->delete();

        return view('/issues/' . $solution->issue_id);
    }
}
