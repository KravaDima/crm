<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'products';

    public $timestamps = false;

    protected $fillable = ['*'];
}
