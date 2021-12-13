@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session()->get('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            <nav class="navbar navbar-light bg-light">
                <h2>Unsolved issues</h2>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" value="{{ $search ?? '' }}" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>

            <table class="table">
              <tbody>
                  @foreach ($openIssues as $issue)
                      <tr>
                          <td style="width: 100px;">
                              <div class="" style="text-align: center; color: #999999;">
                                  <div class="pb-2" style="">
                                      <small>score</small>
                                      <h4><strong>
                                              {{ $issue->voteIssues()->sum('vote') }}
                                          </strong></h4>
                                  </div>
                                  <div class="pb-2">
                                      <small>answers</small>
                                      <h4><strong>{{ $issue->solutions()->count() }}</strong></h4>
                                  </div>

                                  <small>
                                      <strong>
                                          {{ $issue->views ?? 0}}
                                      </strong>
                                      views
                                  </small>
                              </div>
                          </td>
                          <td>
                              <div class="">
                                  <h4>
                                      <a href="issues/{{ $issue->id }}">
                                          {{ $issue->title }}
                                      </a>
                                  </h4>
                              </div>
                              <div class="pb-2" style="color: #999999;">
                                  <h6>
                                      asked by {{ $issue->user->name }} -
                                      {{ \Carbon\Carbon::parse($issue->created_at)->diffForHumans() }}
                                  </h6>
                              </div>
                              <div class="">
                                  {{ $issue->description }}
                              </div>

                              {{-- Mostro i tags --}}
                              <div class="d-flex">
                                  @foreach ($issue->tags as $tag)
                                      @if ( strlen($tag->name) )
                                          <button type="button" class="btn btn-primary btn-sm"
                                              style="margin-right:7px; margin-top:7px;">
                                              {{ strtoupper($tag->name) }}
                                          </button>
                                      @endif
                                  @endforeach
                              </div>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>


          {!! $openIssues ?? ''->appends(['search' => $search ?? ''])->render() !!}


        </div>
    </div>
</div>
@endsection
