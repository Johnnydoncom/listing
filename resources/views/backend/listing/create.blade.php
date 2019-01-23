@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Create Listing'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<!-- <div class="card">
    <div class="card-body"> -->
        <addlisting-component></addlisting-component>
 <!--        <form method="post" action="{{ route('admin.listing.store') }}">
                @csrf
                <div class="row">
                    <div class="col-8 border border-2 border-left-0 border-top-0 border-bottom-0">
                        <div class="form-group col-12">
                            <input type="text" name="name" class="form-control">
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <textarea name="description" class="form-control" rows="10"></textarea>
                        </div>
                    </div>
       
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-lg">Publish</button>
                    </div>
                </div>
        </form> -->
        
   <!--  </div> --><!--card-body-->
<!-- </div> --><!--card-->
@endsection
