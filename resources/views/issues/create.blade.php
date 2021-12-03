@extends('layouts.app')

@section('head')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>








@endsection



@section('content')
    <div class="container">

        <form method="POST" action="/store" enctype="multipart/form-data">
            <div class="row col-10 offset-2">
                @csrf

                <div class="row col-md-10">
                    <h3>New Issue</h3>
                </div>

                <div class="row col-md-10">
                    <label for="title" class="col-md-4 col-form-label">{{ __('Title') }}</label>
                </div>

                <div class="col-md-10">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </input>
                </div>



                <div class="row col-md-10">
                    <label for="description" class="col-md-4 col-form-label">{{ __('Description') }}</label>
                </div>

                <div class="col-md-10">
                    <textarea rows="4" cols="80" id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">
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


                <div class="row col-md-10">
                    <label for="tags" class="col-md-4 col-form-label">{{ __('Tags') }}</label>
                </div>

                <div class="col-md-10">
                    {{-- <input name="tags" type="text" class="form-control" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput" /> --}}
                    <input name="tags" type="text" class="form-control" value="" data-role="tagsinput" />
                </div>
                <div class="col-md-10" style="color: grey">
                    <small>
                        Inserire i tag separati da una virgola. Es.: ED3, PC677C
                    </small>
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
