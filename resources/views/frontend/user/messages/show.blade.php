@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('My Inbox') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header p-0 p-sm-2">
                    <strong>
                        <i class="fas fa-envelope"></i> Inbox - <em>{{ $message->subject }}</em>
                    </strong>
                    <a class="float-right" href="{{ route('frontend.user.message.index') }}" title="">Back to Inbox</a>
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

                        <div class="col-md-8 order-2 order-sm-1">
                            <div class="message-details mb-2 p-2 {{ $message->from->id == Auth::id() ? 'bg-light rounded-left ml-5' : 'bg-primary rounded-right mr-5' }}">
                                <div class="d-flex w-100 justify-content-between">
                                  <small><span class="fa fa-user"></span> <a href="{{ route('frontend.user.profile', $message->from->username) }}">{{ $message->from->name }}</a> <i class="fa fa-clock"></i> {{ $message->created_at->diffForHumans() }}</small>


                                </div>
                                <p class="{{ $message->from->id == Auth::id() ? 'text-right' : '' }}">{!! $message->message !!}</p>
                                
                            </div>

                            @foreach($message->replies as $reply)
                                 <div class="message-details p-2 mb-2 {{ $reply->from->id == Auth::id() ? 'bg-light rounded-left ml-5' : 'bg-primary rounded-right mr-5' }}">
                                    <div class="d-flex w-100 justify-content-end">
                                      <small><span class="fa fa-user"></span> <a href="{{ route('frontend.user.profile', $reply->from->username) }}">{{ $reply->from->name }}</a> <i class="fa fa-clock"></i>{{ $reply->created_at->diffForHumans() }}</small>
                                    </div>

                                    <p class="{{ $reply->from->id == Auth::id() ? 'text-right' : '' }}">{!! $reply->message !!}</p>
                                </div>
                            @endforeach

                            <form action="{{ route('frontend.user.message.reply', encrypt($message->id)) }}" method="post" accept-charset="utf-8">
                                @csrf
                                <div class="form-group">
                                    <textarea name="message" class="form-control" rows="5"></textarea>
                                    <input type="hidden" name="receiver" value="{{ $message->sender }}">
                                    <input type="hidden" name="id" value="{{ encrypt($message->id) }}">
                                    <input type="hidden" name="subject" value="{{ $message->subject }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
