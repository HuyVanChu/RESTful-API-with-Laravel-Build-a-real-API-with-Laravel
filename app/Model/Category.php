<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table ='categories';
    protected $data=['deleted_at'];
    protected $fillable=[
        'name',
        'description'
    ];
    protected $hidden=[
        'pivot',
    ];

    public function prodcuts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
    // public function roles(): BelongsToMany
    // {
    //     return $this->belongsToMany(Role::class, 'role_user_table', 'user_id', 'role_id');
    // }
}
