@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('My Inbox') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> Inbox
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <div class="col col-sm-4 order-1 order-sm-2 mb-4 d-none d-sm-block">
                            <div class="card mb-4 bg-light">
                                <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">

                                <div class="card-body">
                                    <h4 class="card-title">
                                        {{ $logged_in_user->name }}<br/>

                                    </h4>
                                    <p class="card-text">
                                        <small>
                                            <i class="fas fa-envelope"></i> {{ $logged_in_user->email }}<br/>
                                            <i class="fas fa-calendar-check"></i> @lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($logged_in_user->created_at, 'F jS, Y') }}
                                        </small>
                                    </p>

                                    <p class="card-text">

                                        <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-user-circle"></i> @lang('navs.frontend.user.account')
                                        </a>

                                        @can('view backend')
                                            &nbsp;<a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                                <i class="fas fa-user-secret"></i> @lang('navs.frontend.user.administration')
                                            </a>
                                        @endcan
                                    </p>
                                </div>
                            </div>
                        </div><!--col-md-4-->

                        <div class="col-md-8 order-2 order-sm-1 p-0 p-sm-2">
                            <ul class="list-group border-0">
                    
                                @forelse($messages as $message)
                                <li class="list-group-item p-1 mb-2 p-sm-2 border-right-0 border-left-0 border-top-0 border-bottom border-primary">
                                    <div class="row">
                                        <div class="col-sm-2 d-none d-sm-block">
                                            <img class="img-fluid" src="{{ $message->from->picture }}" alt="Card image cap">
                                        </div>
                                        <div class="col-12 col-sm-10">
                                            <div class="row">
                                              <h6 class="mb-1 col-12 col-sm-9"><a href="{{ route('frontend.user.message.show', encrypt($message->id)) }}">{{ $message->subject }}</a></h6>
                                                <small class="col-12 col-sm-3">
                                                <span class="float-sm-right">{{ $message->created_at->diffForHumans() }}</span>
                                                <span class="float-sm-right">By: <a href="#">{{ $message->from->name }}</a></span>
                                                </small>
                                            </div>                                                        
                                            <div class="description mb-1">
                                                {!! strip_tags($message->excerpt()) !!}
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <div>
                                    No data
                                </div>
                                @endforelse
                            </ul>
        
                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
