<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IncomingPaymentOrder extends Model
{
    /*Имя таблицы в Базе Данных*/
    protected $table = 'incoming_payment_orders';

    public $timestamps = true;

    protected $fillable = ['*'];

    /**
     *  Устанавливает связь "один ко многим" номер накладной к сформированным товарам
     */
    public function relationInvoiceIncoming()
    {
        return $this->hasMany('App\Model\IncomingInvoice', 'incoming_payment_order_id', 'id');
    }

    /**
     * Устанавливает связь один к одному между IncomingPaymentOrder и Counterparty
     */
    public function relationCounterparty()
    {
        return $this->hasOne('App\Model\Counterparty', 'id', 'counterparty_id');
    }
}
