<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Tag;
use App\Attachment;
use App\Issue;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class IssueController extends Controller
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
        $search = request()->search ?? '';

        $issues = Issue::where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orderBy('updated_at', 'desc')
            ->paginate(50);

        return view('issues.index', compact('issues', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('issues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        // Salvo l'Issue
        $issue = Issue::create([
            'user_id' => Auth::user()->id,
            'status_id' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'views' => 0,
        ]);

        // Salvo i Tags
        $tags = explode(",", $request->tags);
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $newTag = Tag::firstOrCreate(['name' => strtoupper($tag)]);
                $issue->tags()->attach($newTag);
            }
        }

        // Salvo gli allegati
        $files = $request->file('attachment');
        if (!is_null($files)) {
            foreach ($files as $file) {
                $filename = Str::random(32);

                // Salvo l'immagine
                $file->storeAs('uploads', $filename, 'public');

                $issue->attachments()->create([
                    'file_name' => $filename,
                    'mime_type' => $file->getClientMimeType(),
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect('/home')->with('message', 'Issue created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
      $issue->views++;
        $issue->save();

        foreach ($issue->attachments()->get() as $attachment) {
            if ( strpos($attachment->mime_type, 'image') !== false ) {
                $image = Image::make(public_path('storage/uploads/' . $attachment->file_name))->resize(600, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path("storage/thumbs/" . $attachment->file_name));
            }
        }

        $favorite = $issue->favorites->contains(Auth::user());

        $votes = $issue->voteIssues()->sum('vote');
        $myVote = $issue->voteIssues()->where('user_id', Auth::user()->id)->first()->pivot->vote ?? 0;

        return view('issues.show', compact('issue', 'favorite', 'votes', 'myVote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
