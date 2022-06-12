<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];



    public function setGalleryUrlAttribute($value)
    {
        $this->attributes['gallery_url'] = json_encode($value);
    }

    public function getGalleryUrlAttribute($value)
    {
        return $this->attributes['gallery_url'] = json_decode($value, true);
    }


    public function tags()
    {
        return $this->morphToMany(Tag::class , 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function productMeta()
    {
        return $this->hasOne(ProductMeta::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class , 'coupon_product');
    }
}
