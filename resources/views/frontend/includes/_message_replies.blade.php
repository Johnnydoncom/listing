<!-- _comment_replies.blade.php -->

 @forelse($messages as $message)
         <div class="media">
            <img class="mr-3" src="{{ $message->from->picture }}" alt="{{ $message->from->name }}" width="70">
            <div class="media-body">
              <i class="fa fa-user"></i> by <a href="#">{{ $message->from->name }}</a> 
          | <i class="icon-calendar"></i> {{ $message->created_at->diffForHumans() }}
              <p>{{ $message->message }}</p>

              <a href="" id="reply"></a>
                <form method="post" action="{{ route('frontend.comment.reply.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment_body" class="form-control" />
                        <input type="hidden" name="news_id" value="{{ $news_id }}" />
                        <input type="hidden" name="comment_id" value="{{ $message->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning btn-sm" value="Reply" />
                    </div>
                </form>

                 @include('frontend.includes._message_replies', ['messages' => $message->replies])
            </div>
          </div>
@empty
<p>No comment yet!</p>
@endforelse