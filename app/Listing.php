<?php

namespace App;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'slug', 'description', 'price', 'featured_image', 'category_id', 'make_id', 'carmodel_id', 'user_id','year','location','is_offer'];

    // public function getFeaturedImage(){
    //     return asset('img/frontend/uploads/'.$this->featured_image);
    // }


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

        static::created(function ($listing) {
            $listing->update(['slug' => $listing->title]);
        });
    }

    /**
     * Set the proper slug attribute
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }
        $this->attributes['slug'] = $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }

    public function make()
    {
        return $this->belongsTo(Make::class, 'make_id')->withTrashed();
    }

   	public function model()
    {
        return $this->belongsTo(CarModel::class, 'carmodel_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function getFeaturedImageAttribute($value)
    {
        return asset('img/frontend/uploads/'.$value);
    }

    public function scopeFeaturedImg()
    {
        $file = explode('/', $this->featured_image);
        return end($file);
    }

    public function scopeApproved($query)
    {
        return $query->whereApproved(1);
    }

    public function scopeFilterByRequest($query, Request $request)
    {
        if ($request->input('city_id')) {
            $query->where('city_id', '=', $request->input('city_id'));
        }
        if ($request->input('categories')) {
            $query->whereHas('categories',
            function ($query) use ($request) {
                $query->where('id', $request->input('categories'));
            });
        }
        
        if ($request->input('search')) {
            $query->where('name', 'LIKE', '%'.$request->input('search').'%');
        }
        return $query;
    }

    public function humanDate()
    {
        return $this->created_at->diffForHumans();
    }

    public function getSlugAttribute($value)
    {
        return route('frontend.listing.show',$value);
        // return $value;
    }

    public function isApproved()
    {
        return $this->approved ? true : false;
    }

    public function getShowButtonAttribute()
    {
        return '<a href="' . route('frontend.listing.show', $this) . '" class="btn btn-xs btn-info"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Show Category"></i></a>';
    }



    public function getDeleteButtonAttribute()
    {
        // if ($this->id != auth()->id()) {
            return '<a href="' . route('frontend.listing.destroy', $this) . '"
                 data-method="delete"
                 data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
                 data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
                 data-trans-title="' . trans('strings.backend.general.are_you_sure') . '"
                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a> ';
        // }

        return '';
    }

    public function scopeExcerpt()
    {
        return str_limit($this->description);
    }
}
