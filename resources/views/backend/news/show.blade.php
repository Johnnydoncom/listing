@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('All News'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('News') }} <small class="text-muted">{{ $news->title }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                 <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <form action="{{ route('admin.news.approve') }}" method="post" accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="news" value="{{ $news->id }}">
                    @if($news->isApproved())
                    <button type="submit" class="btn btn-success btn-xs">Deactivate</button>
                    @else
                    <button type="submit" class="btn btn-danger btn-xs">Approve</button>
                    @endif
                  </form>
                    <button href="{{ route('admin.news.index') }}" class="btn btn-success ml-1" data-toggle="modal" data-target="#createNewsModal" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></button>
                </div><!--btn-toolbar -->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
          
                <form class="form-horizontal" action="{{ route('admin.news.update', $news) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                    <textarea name="description" class="form-control" rows="10">{!! $news->description !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                    <img src="{{ $news->image }}" alt="{{ $news->title }}" class="img img-responsive" width="150">
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a class="float-right text-danger" href="{{route('admin.news.destroy', $news->id)}}" data-method="delete" name="delete_item">Delete</a>
                </form>
            </div><!--col-->
        </div><!--row-->
        

        

    </div><!--card-body-->
</div><!--card-->
@endsection
