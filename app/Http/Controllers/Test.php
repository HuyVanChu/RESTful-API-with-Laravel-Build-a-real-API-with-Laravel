<?php

namespace App\Http\Controllers;

use App\Model\Transaction;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function test($id)
    {
        $tran=Transaction::find($id)->products;
        dd($tran);
    }
}
