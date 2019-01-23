@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> My Listings
                    </strong>
                    <a href="{{ route('frontend.user.account.listing.create') }}" class="btn btn-primary float-right" title="Suggest Post">Suggest New</a>
                </div><!--card-header-->

                <div class="card-body">
                
                    @forelse($listings as $listing)
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-header">
                                    {{ $listing->title }} <a class="btn btn-success btn-sm float-right" href="{{ route('frontend.user.account.listing.show', $listing) }}" title=""><i class="far fa-edit"></i></a>
                                    @if($listing->isApproved())
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Pending</span>
                                    @endif
                                </div><!--card-header-->

                                <div class="card-body">
                                   {{ $listing->description }}
                                </div><!--card-body-->
                            </div><!--card-->
                        </div><!--col-md-6-->
                    </div><!--row-->
                    @empty
                    <p>No post found</p>
                    @endforelse

                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
