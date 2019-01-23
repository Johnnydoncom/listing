@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
<div class="row mb-4">
    <div class="col-12">
      <div class="page-header">
          <h3>
              <i class="fas fa-newspaper"></i> Latest News
               <a href="{{ route('frontend.news.create') }}" class="btn btn-primary float-right" title="Suggest Post">Suggest News</a>
          </h3>
      </div>
    </div>
</div>         
    @forelse($allnews as $news)
       <div class="row clearfix mb-3 news-item">
           <div class="col-12 col-sm-2 w-100">
               <img class="img img-fluid featured-img" src="{{ $news->image }}" alt="">
           </div>
           <div class="col-12 col-sm-10">
               <h2 class="title"><a href="{{ route('frontend.news.show', $news->slug) }}">{{ $news->title }}</a></h2>
               <p class="description">{{ $news->excerpt() }}</p>
               <small class="footer-note">
                  <i class="icon-user"></i> by <a href="{{ route('frontend.user.profile', $news->user->username) }}">{{ $news->user->name }}</a> 
                  | <i class="icon-calendar"></i> {{ $news->created_at->diffForHumans() }}
                  | <i class="icon-comment"></i> <a href="#">{{ $news->comments->count() }} comment{{ ($news->comments->count() > 1) ? 's' : '' }}</a>
                  | <i class="icon-tags"></i> Category : <a href="#"><span class="label label-info">{{ $news->category->name }}</span></a> 
                
                </small>
           </div>
       </div>
        <div></div>
    @empty
        <p>No data found.</p>
    @endforelse
    <nav class="d-flex justify-content-center">
      {{ $allnews->links() }}
    </nav>

@endsection
