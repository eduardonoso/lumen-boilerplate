<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'app';

    protected $table = 'teelaunch_products';

//    protected $primaryKey = 'productID';
//
//    protected $keyType = 'str';

    protected $guarded = [];

    protected $hidden = [];
}
