<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    protected $fillable = ['name','description','poster','image', 'path', 'year', 'rating', 'percent'];

    protected $appends = ['poster_path', 'image_path'];

    public function getPosterPathAttribute()
    {
        return Storage::url('images/' . $this->poster);

    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('year', 'like', "%$search%")
                ->orWhere('rating', 'like', "%$search%");
        });

    }

    public function scopeWhenCategory($query, $category)
    {
        return $query->when($category, function ($q) use ($category) {

            return $q->whereHas('categories', function ($qu) use ($category) {

                return $qu->whereIn('category_id', (array)$category)
                    ->orWhereIn('name', (array)$category);

            });

        });

    }

    public function getImagePathAttribute()
    {
        return Storage::url('images/' . $this->image);

    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category');

    }
}
