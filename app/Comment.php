<?php

namespace App;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['author','news_id','comment'];

    public function user()
    {
        return $this->belongsTo(User::class,'author');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
	* Recursively delete the comment with replies all multiple levels
	* @throws Exception
	*/
	public function deleteWithReplies()
	{
		if(count($this->replies) > 0) {
			// Delete children recursive
			foreach ($this->replies as $reply) {
				$reply->deleteWithReplies();
			}
		}
		$this->delete();
	}
}
