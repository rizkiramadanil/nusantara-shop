<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,Sluggable;

    protected $guarded = ['id'];
    protected $with = ['product_category'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

        $query->when($filters['product_category'] ?? false, function($query, $product_category) {
            return $query->whereHas('product_category', function($query) use ($product_category) {
                $query->where('slug', $product_category);
            });
        });
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetails::class, 'product_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
