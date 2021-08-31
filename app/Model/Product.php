<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Seller;
use App\Model\Transaction;
use App\Model\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use SoftDeletes;
    /**
     * https://www.youtube.com/watch?v=0RbRJxjHFX8&t=64s
     * 8. Triển khai các mô hình API RESTful và các mối quan hệ của nó bằng cách sử dụng Laravel Eloquent
     * 2 Implementing The Properties for Product
     * 
     */
    const AVAILABLE_PRODUCT='available';
    const UNAVAILABLE_PRODUCT='unavailable';
    protected $table='products';
    protected $data=['deleted_at'];
    protected $fillable=[
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
    ];
    // http://localhost/RESTful-API/public/api/categories/2/products
    // an pivot khi chay link tren
    protected $hidden=[
        'pivot',
    ];

    public function isAvailable()
    {
        return $this->status==Product::AVAILABLE_PRODUCT;
    }
    public function seller()
    {
        return $this->belongsToMany(Seller::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
