@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> @lang('navs.frontend.dashboard') - {{ $user->name ?? $logged_in_user->name }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                   
                    <div class="row">
                        <div class="col-12 col-sm-4 mb-4 order-1 order-md-2">
                            <div class="card mb-4 bg-light">
                                <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="{{ route('frontend.user.profile', $user->username ?? $logged_in_user->username) }}">{{ $user->name ?? $logged_in_user->name }}</a><br/>
                                    </h4>
                                    <p class="card-text">
                                        <small>
                                            <i class="fas fa-envelope"></i> {{ $user->email ?? $logged_in_user->email }}<br/>
                                            <i class="fas fa-calendar-check"></i> @lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($user->created_at ?? $logged_in_user->created_at, 'F jS, Y') }}
                                        </small>
                                    </p>
                                    <p class="card-text">
                                        @if($user->id == $logged_in_user->id)
                                        <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-user-circle"></i> @lang('navs.frontend.user.account')
                                        </a>
                                        @else
                                            @auth
                                                <button type="button" class="btn btn-primary text-uppercase" data-toggle="modal" data-target="#messageUser">Send Message</button>
                                            @endauth

                                        @endif
                                        @can('view backend')
                                            &nbsp;<a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                                <i class="fas fa-user-secret"></i> @lang('navs.frontend.user.administration')
                                            </a>
                                        @endcan
                                    </p>
                                </div>
                            </div>
                        </div><!--col-md-4-->

                        <div class="col-12 col-md-8 order-2 order-md-1">
                            <h4>Recent Posts</h4>
                            @forelse($allnews as $news)
                            <div class="row carlist mt-4">
                                <div class="col-4">
                                    <img class="img-fluid" src="{{ $news->image }}" alt="Card image cap">
                                </div>
                                <div class="col-8">
                                    <h4 class="title">
                                       <a href="{{ route('frontend.news.show', $news->slug) }}"> {{ str_limit($news->title, 50) }} </a>
                                    </h4>
                                    <div class="description">
                                        {!! $news->excerpt() !!}
                                    </div>
                                    <small>
                                      <i class="icon-user"></i> by <a href="{{ route('frontend.user.profile', $news->user->username ) }}">{{ $news->user->name }}</a> 
                                      | <i class="icon-calendar"></i> {{ $news->created_at->diffForHumans() }}
                                      | <i class="icon-comment"></i> <a href="#">{{ $news->comments->count() }} comment{{ ($news->comments->count() > 1) ? 's' : '' }}</a>
                                      | <i class="icon-tags"></i> Category : <a href="#"><span class="label label-info">{{ $news->category->name }}</span></a> 
                                    </small>
                                </div>
                            </div>
                            @empty
                            <div>
                                No data
                            </div>
                            @endforelse
        
                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->

    @auth
    @if($user->id != $logged_in_user->id)
    <!-- Modal -->
    <div class="modal fade" id="messageUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send message to {{ $user->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('frontend.user.message.store') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="receiver" value="{{ $user->id }}">
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message"></textarea>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endauth
@endsection
