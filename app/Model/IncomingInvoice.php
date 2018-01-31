<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IncomingInvoice extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'incoming_invoices';

    public $timestamps = false;

    protected $fillable = ['*'];

    /**
     * Устанавливает связь один к одному с базой товаров
     */
    public function relationProduct()
    {
        return $this->hasOne('App\Model\Product', 'id', 'product_id');
    }
}
