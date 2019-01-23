@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('Suggest News') )

@section('content')
    <div class="row mb-4">
        <div class="col-12 col-sm-8 offset-sm-2">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> Create News
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                <form class="form-horizontal" action="{{ route('frontend.news.store') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label class="form-control-label" for="title">News Title</label>
                    <input type="text" name="title" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="category">News Category</label>
                    <select name="category" class="form-control">
                      <option value="1" selected>Select Category</option>
                      @foreach($newscategories as $newscat)
                      <option value="{{ $newscat->id }}">{{ $newscat->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="description">News Description</label>
                    <textarea name="description" class="form-control" rows="5"></textarea>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
