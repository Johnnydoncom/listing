<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class News extends Model
{
    protected $fillable = ['title','category_id','slug','description', 'author', 'image'];

    public static function boot()
    {
       	parent::boot();

       	static::creating(function($model) {
           $model->slug = str_slug($model->title);// change the ToBeSluggiefied

           $latestSlug =
               static::whereRaw("slug = '$model->slug' or slug LIKE '$model->slug-%'")
                   ->latest('id')
                   ->value('slug');
           if ($latestSlug) {
               $pieces = explode('-', $latestSlug);

               $number = intval(end($pieces));

               $model->slug .= '-' . ($number + 1);
           }
       	});
     	static::created(function ($model) {
            $model->update(['slug' => $model->title]);
		});
    }

	/**
     * Set the proper slug attribute.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        if (static::whereSlug($value)->exists()) {
            $slug = $this->incrementSlug($slug);
        }
        $this->attributes['slug'] = $slug ?? str_slug($this->title);
	}

    public function category()
    {
    	return $this->belongsTo(NewsCategory::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'author');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function scopeExcerpt()
    {
    	return str_limit($this->description);
    }

    public function scopeApprovedNews()
    {
    	return static::whereActive('1');
    }

    public function scopeApproved($query)
    {
        return $query->whereActive(1);
    }

    public function isApproved()
    {
        return $this->active ? true : false;
    }

    public function getImageAttribute($value)
    {
    	if($value){
    		return asset('img/frontend/uploads/'.$value);
    	}else{
    		return asset('img/frontend/uploads/default.jpg');
    	}
        
    }

    public function scopeFeaturedImage()
    {
        $file = explode('/', $this->image);
        return end($file);
    }

    public function getShowButtonAttribute()
    {
        return '<a href="' . route('admin.news.show', $this) . '" class="btn btn-sm btn-info"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Show Category"></i></a>';
    }
    public function getDeleteButtonAttribute()
    {
        // if ($this->id != auth()->id()) {
            return '<a href="' . route('admin.news.destroy', $this) . '"
                 data-method="delete"
                 data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
                 data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
                 data-trans-title="' . trans('strings.backend.general.are_you_sure') . '"
                 class="btn btn-sm btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a> ';
        // }

        return '';
    }

    public function getApproveButtonAttribute()
    {
    	$approved = '<a href="#" class="btn btn-sm btn-success" onclick="event.preventDefault(); document.getElementById(\'approval-'.$this->id.'\').submit();"><i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="Deactivate News"></i></a>';
    	$pending = '<a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById(\'approval-'.$this->id.'\').submit();"><i class="fa fa-stop-circle" data-toggle="tooltip" data-placement="top" title="Activate News"></i></a>';
        return ($this->isApproved() ? $approved : $pending) . '<form id="approval-'.$this->id.'" action="'. route('admin.news.approve') .'" method="post" accept-charset="utf-8">'.
                    csrf_field() .'
                    <input type="hidden" name="news" value="'.$this->id.'">
                  </form>';
    }


    
}
