@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="row mb-4 d-flex align-middle align-items-center">
        <div class="col-12 col-sm-9 border-right border-primary pb-3 pb-sm-0">
           Griptorque.org is a free online community where intelligent minds from around the world come to debate online and read the opinions of others. Research today’s most controversial debate topics and cast your vote on our opinion polls.
        </div><!--col-->
        <div class="col-12 col-sm-3">
            <a href="{{ route('frontend.auth.register') }}" title="" class="btn btn-primary">Become a Member</a>
        </div>
    </div><!--row-->
    <hr>
    <div class="mb-5">
        <h4 class="text-primary mb-1">Recent News</h4>
        <p class="mb-4 d-none d-sm-block"> Investigate today’s most controversial debate topics covering society’s biggest issues in politics, religion, education and more. Gain balanced, non-biased insight into each issue and review the breakdown of pro-con stances within our community. </p>
        <div class="row">
            @foreach($newsitems->slice(3) as $news)
            <div class="col-12 col-sm-4 mb-2 mb-sm-auto">
              <div class="card newsbox">
                  <img class="card-img-top" src="{{ $news->image }}" alt="{{ $news->title }}">
                  <small class="date text-center mt-auto mb-auto">{{ $news->created_at->format('M d')}}</small>
                  <div class="card-body">
                     <h2 class="title">
                        <a href="{{ route('frontend.news.show', $news->slug) }}">
                          {{ str_limit($news->title, 60) }}
                        </a>
                      </h2>
                      <small class="footer-note">
                          <i class="fa fa-user"></i> <a href="{{ route('frontend.user.profile', $news->user->username) }}">{{ $news->user->name }}</a>
                          | <i class="fa fa-comment"></i> <a href="#">{{ $news->comments->count() }} comment{{ ($news->comments->count() > 1) ? 's' : '' }}</a>
                          | <i class="fa fa-tags"></i><a href="#"><span class="label label-info">{{ $news->category->name }}</span></a>

                      </small>
                      <div class="mt-1">
                          <p>{{ $news->excerpt() }}</p>
                     </div>
                  </div>

                </div>
            </div>
            @endforeach
      </div>
    </div>

    {{--Car Listing--}}



    <hr>
    <div class="mb-5">
        <h4 class="text-primary mb-1">Recent Cars</h4>
        <div class="row">
            @foreach($latestcarposts as $latestcar)
                <div class="col-12 col-sm-4 mb-2 mb-sm-auto">
                    <div class="card carsbox">
                        <img class="card-img-top" src="{{ $latestcar->featured_image }}" alt="{{ $latestcar->title }}">
                        <small class="price text-center mt-auto">{{ $latestcar->is_offer ? 'Offer' : '$'. number_format($latestcar->price,2) }}</small>
                        <div class="card-body">
                            <h2 class="title">
                                <a href="{{ $latestcar->slug }}">
                                    {{ str_limit($latestcar->title, 60) }}
                                </a>
                            </h2>
                            <div class="mt-1">
                                <small class="text-muted">{{ $latestcar->created_at->diffForHumans() }}</small>
                                <small class="float-right text-muted">{{ $latestcar->location }}</small>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
