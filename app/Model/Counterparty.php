<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Counterparty extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'counterparties';

    public $timestamps = false;

    protected $fillable = ['*'];
}
