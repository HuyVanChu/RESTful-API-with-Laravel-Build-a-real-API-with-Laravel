<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Transaction;
class Buyer extends User
{
    protected $table='users';
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
