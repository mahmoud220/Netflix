@extends('layouts.dashboard.app')
@push('styles')
    <style>
        #movie__upload-wrapper{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25vh;
            flex-direction: column;
            cursor: pointer;
            border: 1px solid black;
        }
    </style>
@endpush
@section('content')
<div>
<h2>Movies</h2>
</div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('dashboard.movies.index')}}">Movies</a></li>
          <li class="breadcrumb-item active">Add</li>
        </ul>

      <div class="row">
          <div class="col-md-12">
            <div class="tile mb-4">
                <div id="movie__upload-wrapper" onclick="document.getElementById('movie__file-input').click()">
                    <i class="fa fa-video-camera fa-2x"></i>
                    <p>Click to upload</p>
                </div>
            <input type="file" name="" data-movie-id="{{ $movie->id }}" data-url="{{ route('dashboard.movies.store') }}" id="movie__file-input" style="display: none;">
                <form id="movie__properties" method="post" action="{{ route('dashboard.movies.update', $movie->id) }}" style="display:none;">
                  @csrf
                  @method('post')
                  @include('dashboard.partials._errors')

                  <div class="form-group">
                      <label>Uploading</label>
                    <div class="progress">
                        <div class="progress-bar" id="movie__upload-progress" role="progressbar"></div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" id="movie__name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control">
                      </div>

                      <div class="form-group">
                        <label>Poster</label>
                        <input type="file" name="poster" class="form-control">
                      </div>

                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                      </div>

                      <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="year" class="form-control">
                      </div>

                      <div class="form-group">
                        <label>Rating</label>
                        <input type="number" min="1" name="rating" class="form-control">
                      </div>

                  <div class="form-group">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                  </div>
                </form>

      </div>
@endsection
