@extends('layouts.app')

@section('content')
    <div class="container">

        <form method="POST" action="issues/{{ $issue->id }}/solutions/store" enctype="multipart/form-data">
            <div class="row col-10 offset-2">
                @csrf

                <div class="row col-md-10 pt-3">
                    <h4>
                        {{ $issue->title }}
                    </h4>
                </div>

                <div class="row col-md-10 pt-3 pb-3">
                        {{ $issue->description }}
                </div>

                <div class="row col-md-10">
                    <label for="description" class="col-md-4 col-form-label">{{ __('Write your solution') }}</label>
                </div>

                <div class="col-md-9">
                    <textarea rows="4" cols="80" id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
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
                        {{ __('Submit') }}
                    </button>
                </div>

            </div>

        </form>
    </div>
@endsection
