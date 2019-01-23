@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@push('after-scripts')
  <script>
    $(".replyForm").click(function(event) {
      event.preventDefault();
      var id = $(this).attr('id');
      var ev = $("#replyForm-"+id).toggle();
    });
  </script>
@endpush
@section('content')
<div class="row mb-5">
        <div class="col-12 col-md-8">
          <h2>{{ $news->title }}</h2>
          <img class="img img-fluid" src="{{ $news->image }}" alt="{{ $news->title }}">
          <p>
              <i class="icon-user"></i> by <a href="{{ route('frontend.user.profile', $news->user->username) }}">{{ $news->user->name }}</a> 
              | <i class="icon-calendar"></i> {{ $news->created_at->diffForHumans() }}
              | <i class="icon-comment"></i> <a href="#">{{ $news->comments->count() }} comment{{ ($news->comments->count() > 1) ? 's' : '' }}</a>
              | <i class="icon-tags"></i> Category : <a href="#"><span class="label label-info">{{ $news->category->name }}</span></a> 
            
            </p>
          <p>{!! $news->description !!}</p>
          <div class="comment mt-4">
            <h4 class="mb-4">Comments</h4>
            @include('frontend.includes._comment_replies', ['comments' => $news->comments, 'news_id' => $news->id])
            <hr />
            <form action="{{ route('frontend.comment.store') }}" method="post" accept-charset="utf-8">
                @csrf
                <div class="form-group">
                  <textarea name="comment" class="form-control" rows="5"></textarea>
                  <input type="hidden" name="news" value="{{ $news->id }}">
                </div>
                <button type="submt" class="btn btn-primary">Comment</button>
            </form>
          </div>
        </div>
        <div class="col-12 col-md-4 d-none d-md-block">
          <div class="card mb-2">
            <div class="card-body d-flex align-con">
                <a href="{{ route('frontend.news.create') }}" class="btn btn-primary" title="Suggest Post">Suggest News</a>
            </div>
          </div>
           <div class="card">
                <div class="card-header">
                    Recent News
                </div><!--card-header-->

                <div class="card-body p-0">
                   <ul class="list-group border-0">
                  @foreach($recentnews as $recentNews)

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          {{ $recentNews->title }}
                          <span class="badge badge-primary badge-pill">14</span>
                        </li>
                       
                   
                  @endforeach
                    </ul>
                </div>
            </div>
        </div>
       
</div>
             
@endsection
