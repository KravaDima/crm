<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Counterparty;

class CounterpartyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $counterparties = Counterparty::all();
        $counterpartyInfo['counterparties'] = $counterparties->toArray();

        return view('counterparty', $counterpartyInfo);
    }

    /**
     * Сохранение информации при добавлении или редактировании контрагента
     */
    public function setCounterparty(Request $request)
    {
        $id = $request->counterparty_id;
        $type = $request->counterparty_type;
        $name = $request->counterparty_name;
        $tel = $request->counterparty_tel;
        $email = $request->counterparty_email;

        if($id) {
            $counterparty = Counterparty::find($id);
            $counterparty->type = $type;
            $counterparty->name = $name;
            $counterparty->tel = $tel;
            $counterparty->email = $email;
        } else {
            $counterparty = new Counterparty();

            $counterparty->type = $type;
            $counterparty->name = $name;
            $counterparty->tel = $tel;
            $counterparty->email = $email;
        }
        $counterparty->save();

        $counterparty = $this->getAllCounterparty();

        return $counterparty;

    }

    /**
     * Получение данных по конкретному контрагенту
     */
    public function getCounterparty(Request $request)
    {
        $id = $request->id;

        $counterpartyInfo = Counterparty::find($id);
        $counterparty = $counterpartyInfo->toArray();

        return $counterparty;
    }

    /**
     * Удаление контрагента
     */
    public function delCounterparty(Request $request)
    {
        $id = $request->id;

        if(Counterparty::destroy($id)) {
            return $this->getAllCounterparty();
        }
    }

    /**
     * Получение списка всех контрагентов
     *
     * @return array
     */
    public function getAllCounterparty()
    {
        $items = Counterparty::all();
        $counterparty = $items->toArray();

//        dump($products);
        return $counterparty;
    }
}
