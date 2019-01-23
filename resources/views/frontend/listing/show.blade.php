@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div class="row mt-5 mb-4">
    <div class="col-12 col-sm-7">        
        <div class="card mb-2">
            <div class="card-body">
                <img src="{{ $listing->featured_image }}" alt="{ $listing->title }}" class="img img-fluid">
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Description</h4>
                {{ $listing->description }}
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-5">
        <div class="card">
            <div class="card-body pb-1">
                <div class="d-flex w-100 justify-content-between">
                  <h4 class="mb-1 list-title text-primary"><strong>{{ $listing->is_offer ? 'Offer' : '$' . number_format($listing->price, 2) }}</strong></h4>
                  <span><i class="fa fa-share-alt fa-2x mx-1"></i><i class="far fa-heart fa-2x mx-1"></i></span>
                </div> 
                    <p>
                        <h6>{{ $listing->title }}</h6>
                    </p>
                    
                    <p class="text-right clearfix">
                        <span class="float-left text-left">
                            <strong>Make</strong><br>
                            <small class="text-muted">{{ $listing->make->name }}</small>
                        </span>
                        @if($listing->model)
                        <span class="text-right">
                             <strong>Model</strong><br>
                            <small class="text-muted">{{ $listing->model->name }}</small>
                        </span>
                         @endif
                    </p>
                    <p class="text-right">
                        <span class="float-left text-left">
                            <strong>Category</strong><br>
                            <small class="text-muted">{{ $listing->category->name }}</small>
                        </span>
                        <span class="text-left">
                            <strong>Year</strong><br>
                            <small class="text-muted">{{ $listing->year }}</small>
                        </span>
                    </p>
                    <p class="text-right text-muted">
                        <small class="text-left float-left">{{ $listing->location }}</small>
                        <small>{{ $listing->created_at->diffForHumans() }}</small>
                    </p>
                
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                   <div class="seller-description">
                        <h5 class="heading">Seller description</h5>
                        <div class="media">
                            <img class="align-self-center mr-3 rounded-circle" src="{{ $listing->user->picture }}" alt="{{ $listing->user->name }}">
                            <div class="media-body">
                              <h5 class="mt-0 mb-0 seller-name"><a href="{{ route('frontend.user.profile', $listing->user->username) }}">{{ $listing->user->name }}</a></h5>
                              <small><a href="{{ route('frontend.user.profile', $listing->user->username) }}">View {{ $listing->user->name }}'s profile</a></small>
                            </div>
                        </div>
                            @auth
                            @cannot('update', $listing)
                                <button type="button" class="btn btn-primary btn-block mt-2 text-uppercase" data-toggle="modal" data-target="#contactSeller">Contact Seller</button>
                            @endcannot

                            @else
                            <div class="mt-2 border-top text-center">
                                 <a href="{{route('frontend.auth.login')}}">Login</a> to contact seller
                             </div> 
                            @endauth
                    </div>
            </div>
        </div>
    </div>
</div>
@auth
<!-- Modal -->
<div class="modal fade" id="contactSeller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact {{ $listing->user->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="{{ route('frontend.user.message.store') }}">
      <div class="modal-body">
       
            @csrf
          <div class="form-group">
            <input type="hidden" name="receiver" value="{{ $listing->user->id }}">
            <input type="hidden" name="listing" value="{{ $listing->id }}">
            <input type="hidden" name="subject" value="Re: {{ $listing->title }}">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ Auth::user()->name }}" readonly="">
            </div>
           
            <div class="form-group">
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
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
@endauth
@endsection
