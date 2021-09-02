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
}
