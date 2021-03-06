@extends('layouts.app')

@section('head')

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session()->get('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between">
                    <div class="row pt-4 d-flex  justify-content-between">
                        <h4>
                            {{ $issue->title }}
                        </h4>

                    </div>
                    <div class="pt-4">
                        <favorite-button issue-id="{{ $issue->id }}" favorite="{{ $favorite }}">
                        </favorite-button>
                    </div>
                </div>

                <div class="row pb-5">
                    asked by {{ $issue->user->name }} -
                    {{ \Carbon\Carbon::parse($issue->created_at)->diffForHumans() }}
                </div>



                <table class="table">
                    <tbody>

                        {{-- Question --}}
                        <tr>
                            <td style="width: 60px;text-align:center">
                                <vote-buttons type="issues" issue-id="{{ $issue->id }}" votes="{{ $votes }}"
                                    my-vote="{{ $myVote }}">
                                </vote-buttons>
                            </td>

                            <td>
                                <div class="pb-3">
                                    {!! App\MarkdownParser::parse($issue->description) !!}
                                </div>


                                {{-- Mostro i tags --}}
                                <div class="d-flex pb-3">
                                    @foreach ($issue->tags as $tag)
                                        @if (strlen($tag->name))
                                            <button type="button" class="btn btn-primary btn-sm"
                                                style="margin-right:7px; margin-top:7px;">
                                                {{ strtoupper($tag->name) }}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="row pt-5">
                                    @foreach ($issue->attachments()->get() as $attachment)
                                        <a href="attachment/{{ $attachment->id }}/open">
                                            @if ($attachment->isAnImage())
                                                <img src={{ '/storage/thumbs/' . $attachment->file_name }}
                                                    style="max-height: 250px;">
                                            @else
                                                {{-- Non si tratta di una immagine --}}
                                                {{ $attachment->original_name }}
                                            @endif
                                        </a>
                                        <a href="attachment/{{ $attachment->id }}/download">
                                            <img src={{ '/images/file_download.png' }} style="max-height: 34px;">
                                        </a>
                                    @endforeach
                                </div>

                            </td>
                        </tr>


                    </tbody>
                </table>

                <div class="row pt-3">
                    <h4>
                        {{ $issue->solutions()->count() }} answers
                    </h4>

                </div>

                <table class="table">
                    <tbody>
                        @if ($issue->solutions()->count() > 0)
                            @foreach ($issue->solutions()->get() as $solution)
                                <tr>
                                    <td style="width: 60px;text-align:center">

                                        <vote-buttons type="solutions" issue-id="{{ $solution->id }}"
                                            votes="{{ $solution->votes()->sum('vote') }}"
                                            my-vote="{{ $solution->votes->where('user_id', Auth::user()->id)->first()->pivot->vote ?? 0 }}">
                                        </vote-buttons>
                                    </td>


                                    <td>
                                        {{-- Risposta --}}
                                        <div class="">
                                            {!! App\MarkdownParser::parse($solution->description) !!}
                                        </div>

                                        {{-- Attachmemnt --}}
                                        <div class="pt-1">
                                            @foreach ($solution->attachments()->get() as $attachment)
                                                <a href="attachment/{{ $attachment->id }}/open">
                                                    @if ($attachment->isAnImage())
                                                        <img src={{ '/storage/thumbs/' . $attachment->file_name }}
                                                            style="max-height: 250px;">
                                                    @else
                                                        {{-- Non si tratta di una immagine --}}
                                                        {{ $attachment->original_name }}
                                                    @endif
                                                </a>
                                                <a href="attachment/{{ $attachment->id }}/download">
                                                    <img src={{ '/images/file_download.png' }} style="max-height: 34px;">
                                                </a>
                                            @endforeach
                                        </div>


                                        <div class="d-flex justify-content-between">
                                            {{-- Data e utente --}}
                                            <div class="pb-5 pt-1" style="color: #999999">
                                                Answered
                                                {{ \Carbon\Carbon::parse($solution->created_at)->diffForHumans() }} -
                                                {{ $solution->user->name }}
                                            </div>
                                            {{-- Edit / Delete --}}
                                            @can('update', $solution)
                                                <div class="pb-3 d-flex" style="color: #999999">
                                                    <div class="pr-3">
                                                        <a href="">Edit</a>
                                                    </div>
                                                    |
                                                    <delete-solution solution-id="{{ $solution->id }}"
                                                        class="pl-3"></delete-solution>
                                                </div>
                                            @endcan
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>


                <div class="row pt-3">
                    <h4>
                        Your answer
                    </h4>
                </div>

                <form method="POST" action="issues/{{ $issue->id }}/solutions/store" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-10">
                        <textarea rows="6" cols="80" id="description" type="description"
                            class="form-control
                        @error('description')
                            is-invalid
                        @enderror"
                            name="description" value="{{ old('description') }}" required autocomplete="description">
                                                    </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row col-md-8 pt-4">
                        <label for="attachment" class="col-md-4 col-form-label">{{ __('Attachments') }}</label>
                    </div>

                    <div class="form-group form-control-md row col-md-8 pl-4">
                        <input type="file" multiple class="form-control-file" name="attachment[]" id="attachment">
                    </div>

                    <div class="col-md-10 pt-5">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Post your answer') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>


@endsection
