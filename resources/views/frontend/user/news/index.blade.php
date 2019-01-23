@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('My News Post') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> My News
                    </strong>
                    <a href="{{ route('frontend.user.account.news.create') }}" class="btn btn-primary float-right" title="Suggest Post">Suggest New</a>
                </div><!--card-header-->

                <div class="card-body">
                    @forelse($news as $newz)
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-header">
                                    {{ $newz->title }} 
                                    <a class="btn btn-danger btn-sm float-right" href="{{route('frontend.user.account.news.destroy', $newz->id)}}" data-method="delete" name="delete_item"><i class="fa fa-times"></i></a>
                                    <a class="btn btn-success btn-sm float-right" href="{{ route('frontend.user.account.news.show', $newz) }}" title=""><i class="far fa-edit"></i></a>
                                    @if($newz->isApproved())
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Pending</span>
                                    @endif
                                </div><!--card-header-->

                                <div class="card-body">
                                   {{ $newz->excerpt() }}
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
