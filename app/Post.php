<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'category_id', 'featured', 'slug',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function deleteImage()
    {
        unlink($this->featured);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tag_id)
    {
        return in_array($tag_id, $this->tags->pluck('id')->toArray());
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
