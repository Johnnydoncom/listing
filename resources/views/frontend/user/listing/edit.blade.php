@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('Edit Listing') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-edit"></i> {{ $listing->title }}
                    </strong>
                    <a href="{{ route('frontend.user.account.listing.create') }}" class="btn btn-primary float-right" title="Suggest Post">Suggest New</a>
                </div><!--card-header-->

                <div class="card-body">

                <editlisting-component :slisting=" {{ $listing }}"></editlisting-component>

                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
