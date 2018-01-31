<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OutgoingPaymentOrder extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'outgoing_payment_orders';

    public $timestamps = true;
}
