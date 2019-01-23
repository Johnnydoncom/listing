@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('Suggest News') )

@section('content')
    <div class="row mb-4">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> Update - {{ $news->title }}
                    </strong>{!! $news->active ? '<span class="badge badge-default">Approved</span>' : '<span class="badge badge-danger">Pending</span>' !!} <a class="btn btn-link float-right text-danger" href="{{ route('frontend.user.account.news.index') }}" title="Go Back">Back</a>
                </div><!--card-header-->

                <div class="card-body">
                <form class="form-horizontal" action="{{ route('frontend.user.account.news.update', $news) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label class="form-control-label" for="title">News Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $news->title }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="category">News Category</label>
                    <select name="category" class="form-control">
                      <option value="1">Select Category</option>
                      @foreach($newscategories as $newscat)
                      <option value="{{ $newscat->id }}" {{ $newscat->id == $news->category_id ? "selected" : '' }}>{{ $newscat->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="description">News Description</label>
                    <textarea name="description" class="form-control" rows="5">{!! $news->description !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                    <img src="{{ $news->image }}" alt="{{ $news->title }}" class="img img-responsive" width="150">
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{route('frontend.user.account.news.destroy', $news->id)}}" data-method="delete" name="delete_item">Delete</a>
                </form>

                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
