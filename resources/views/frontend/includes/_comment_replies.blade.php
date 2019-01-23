<!-- _comment_replies.blade.php -->

 @foreach($comments as $comment)
         <div class="media comment">
            <img class="mr-sm-3" src="{{ $comment->user->userImage() }}" alt="{{ $comment->user->name }}">
            <div class="media-body">
              <a href="#">{{ $comment->user->name }}</a> 
          | <i class="icon-calendar"></i> {{ $comment->created_at->diffForHumans() }}
              <p>{{ $comment->body }}</p>

              <a href="#" class="replyForm" id="{{ $comment->id }}"><span class="fa fa-reply"></span></a>
                <form id="replyForm-{{ $comment->id }}" class="form" method="post" action="{{ route('frontend.comment.reply.store') }}" style="display: none;">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment_body" class="form-control" />
                        <input type="hidden" name="news_id" value="{{ $news_id }}" />
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-sm float-right" value="Reply" />
                    </div>
                </form>

                 @include('frontend.includes._comment_replies', ['comments' => $comment->replies])
            </div>
          </div>
@endforeach