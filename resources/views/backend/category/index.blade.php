@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Categories'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('Listing') }} <small class="text-muted">{{ __('Categories') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <button href="{{ route('admin.category.index') }}" class="btn btn-success ml-1" data-toggle="modal" data-target="#createCategoryModal" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></button>
                </div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{!! $category->name !!}</td>
                                <td>
                                    {!! $category->showButton !!} 
                                    {!! $category->deleteButton !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        

        <!-- Create Category Modal -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="addCategory" method="post" action="{{ route('admin.category.store') }}">
                    @csrf
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required="">
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('addCategory').submit();">Add</button>
              </div>
            </div>
          </div>
        </div>

    </div><!--card-body-->
</div><!--card-->
@endsection
