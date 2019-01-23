@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('All Listings'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Make</th>
                        <th>Year</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listings as $listing)
                    <tr>
                        <td>{{ $listing->title }}</td>
                        <td>{{ $listing->category->name }}</td>
                        <td>{{ $listing->make->name }}</td>
                        <td>{{ $listing->year }}</td>
                        <td>
                            <!-- <a href="#" class="btn btn-danger btn-sm float-right"><span class="fa fa-trash"></span></a> -->
                            <a class="btn btn-danger btn-sm float-right" href="{{route('admin.listing.destroy', $listing->id)}}" data-method="delete" name="delete_item"><span class="fa fa-trash"></span></a>

                            <a href="{{route('admin.listing.show', $listing->id)}}" class="btn btn-primary btn-sm float-right"><span class="fa fa-edit"></span></a>
                            @if($listing->isApproved())
                                <form class="form form-inline float-right" action="{{ route('admin.approve.listing') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                    <button type="submit" class="btn btn-success btn-sm float-right">Disapprove</button>
                                </form>
                            @else
                                <form class="form form-inline float-right" action="{{ route('admin.approve.listing') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm float-right">Approve</button>
                                </form>
                                
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6">No  data found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
   </div><!--card-body-->
</div><!--card-->
@endsection
