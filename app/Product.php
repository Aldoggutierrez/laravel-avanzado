<?php

namespace App;

use App\Utils\CanBeRated;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CanBeRated;
    protected $fillable = [
        'name',
        'price'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function booted()
    {
      static::creating(function(Product $product){
	$faker = \Faker\Factory::create();
	$product->image_url = $faker->imageUrl();
	$product->createdBy()->associate(auth()->user());	
      });
    }

}
