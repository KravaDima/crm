<?php

namespace App\Http\Controllers;

use App\Model\Counterparty;
use Illuminate\Http\Request;
use App\Model\IncomingPaymentOrder;

class IncomingPaymentOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = IncomingPaymentOrder::all();
        $counterparty = Counterparty::all()->where('type', 2);
        $orders['orders'] = $orders->toArray();
        $orders['counterparties'] =  $counterparty->toArray();

        return view('incoming-payment-order', $orders);
    }

    /**
     * Сохранение информации при добавлении или редактировании приходного ордера
     */
    public function setIncomingPaymentOrder(Request $request)
    {
        $id = $request->counterparty_id;
        $type = $request->counterparty_type;
        $name = $request->counterparty_name;
        $tel = $request->counterparty_tel;
        $email = $request->counterparty_email;

        if($id) {
            $order = IncomingPaymentOrder::find($id);
            $order->type = $type;
            $order->name = $name;
            $order->tel = $tel;
            $order->email = $email;
        } else {
            $order = new IncomingPaymentOrder();

            $order->type = $type;
            $order->name = $name;
            $order->tel = $tel;
            $order->email = $email;
        }
        $order->save();

        $orders = $this->getAllIncomingPaymentOrder();

        return $orders;

    }

    /**
     * Получение данных по конкретному контрагенту
     */
    public function getCounterparty(Request $request)
    {
        $id = $request->id;

        $ordersInfo = Counterparty::find($id);
        $orders = $ordersInfo->toArray();

        return $orders;
    }

    /**
     * Удаление ордера
     */
    public function delIncomingPaymentOrder(Request $request)
    {
        $id = $request->id;

        if(IncomingPaymentOrder::destroy($id)) {
            return $this->getAllIncomingPaymentOrder();
        }
    }

    /**
     * Получение списка всех ордеров
     *
     * @return array
     */
    public function getAllIncomingPaymentOrder()
    {
        $items = IncomingPaymentOrder::all();
        $orders = $items->toArray();

        return $orders;
    }
}
