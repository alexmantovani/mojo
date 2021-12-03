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
                <h2>Task list</h2>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" value="{{ $search ?? '' }}" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>


            <h3>Unsolved issues</h3>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Author</th>
                  <th scope="col">Title</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($openIssues as $issue)
                      <tr>
                        <td>{{ $issue->user->name }}</td>
                        <td>
                            <div class="">
                                <h4>
                                {{ $issue->title }}
                            </h4>
                            </div>
                            <div class="">
                                {{ $issue->description }}
                            </div>

                            <div class="d-flex">
                                @foreach ($issue->tags as $tag)
                                    <button type="button" class="btn btn-secondary btn-sm" style="margin-right:7px; margin-top:7px;">
                                        {{ $tag->name }}
                                    </button>
                                @endforeach
                            </div>


                        </td>
                        <th>button</th>
                      </tr>
                  @endforeach
              </tbody>
            </table>









            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action active">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">List group item heading</h5>
                  <small>3 days ago</small>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                <small>Donec id elit non mi porta.</small>
              </a>
              <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">List group item heading</h5>
                  <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                <small class="text-muted">Donec id elit non mi porta.</small>
              </a>
              <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">List group item heading</h5>
                  <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                <small class="text-muted">Donec id elit non mi porta.</small>
              </a>
            </div>



        </div>
    </div>
</div>
@endsection
