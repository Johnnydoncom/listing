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
                    {{ __('News') }} <small class="text-muted">{{ __('All News') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <button href="{{ route('admin.news.index') }}" class="btn btn-success ml-1" data-toggle="modal" data-target="#createNewsModal" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></button>
                </div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-responsive table-striped">
                        <thead>
                        <tr>
                            <th style="width: 10px;">S/N</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allnews as $key => $news)
                            <tr>
                                <th>{{ $key+1 }}</th>
                                <td>{!! $news->title !!}</td>
                                <td>{!! $news->user->name !!}</td>
                                <td>
                                    {!! $news->showButton !!} 
                                    {!! $news->deleteButton !!}
                                    {!! $news->approveButton !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-right">
                                <td colspan="4" >{{ $allnews->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        

        <!-- Create News Modal -->
        <div class="modal fade" id="createNewsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
           
              <div class="modal-body">
                <form id="addNews" class="form-horizontal" action="{{ route('admin.news.store') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
                    <textarea name="description" class="form-control" rows="10"></textarea>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label" for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                  </div>
               </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('addNews').submit();">Add News</button>
              </div>

            </div>
          </div>
        </div>

    </div><!--card-body-->
</div><!--card-->
@endsection
