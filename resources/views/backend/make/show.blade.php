@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Categories'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form class="form-inline" method="post" action="{{ route('admin.make.update', $make) }}">
            @csrf
            @method('PATCH')
                <div class="form-group col-12">
                    <input type="text" name="name" class="form-control" value="{{ $make->name }}" style="width: 90%">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
        </form><!--row-->
        <hr>

        <div class="row mt-4">
                <div class="col">
                  <form class="form-inline" method="post" action="{{ route('admin.store.model') }}">
                        @csrf
                            <div class="form-group col-12">
                                <input type="text" name="name" class="form-control" placeholder="Model Name">
                                <input type="hidden" name="make_id" value="{{ $make->id }}">
                                <button class="btn btn-primary" type="submit">Add Model</button>
                            </div>
                    </form><!--row-->
                </div>
                <div class="col">
                      <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Make</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                                <tr>
                                    <td>{!! $model->name !!}</td>
                                    <td>
                                        {!! $model->showButton !!} 
                                        {!! $model->deleteButton !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
       
        

        <!-- Create Category Modal -->
        <div class="modal fade" id="createMakeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="addMake" method="post" action="{{ route('admin.make.store') }}">
                    @csrf
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Make Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required="">
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('addMake').submit();">Add</button>
              </div>
            </div>
          </div>
        </div>

    </div><!--card-body-->
</div><!--card-->
@endsection
