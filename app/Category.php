<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
      use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    public function listings()
    {
        return $this->belongsToMany(Listing::class);
    }

    public static function categories()
    {
        return static::pluck('name', 'id');
    }



	public function getShowButtonAttribute()
	{
	    return '<a href="' . route('admin.category.show', $this) . '" class="btn btn-xs btn-info"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Show Category"></i></a>';
	}



	public function getDeleteButtonAttribute()
	{
	    // if ($this->id != auth()->id()) {
	        return '<a href="' . route('admin.category.destroy', $this) . '"
	             data-method="delete"
	             data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
	             data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
	             data-trans-title="' . trans('strings.backend.general.are_you_sure') . '"
	             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a> ';
	    // }

	    return '';
	}




}
