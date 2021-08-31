<?php

namespace App\Model;
use App\Model\Product;
use App\Scopes\SellerScopes;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends User
{
    use SoftDeletes;
    protected $table='users';
    protected $data=['deleted_at'];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SellerScopes);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
