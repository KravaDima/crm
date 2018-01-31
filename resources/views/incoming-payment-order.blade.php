@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Приходный ордер</div>

                    <div class="panel-body">
                        <a href="#modal" class="btn btn-success"  data-toggle="modal" onclick="">Добавить</a>
                    </div>
                    {{--<a href="#modal3" data-fancybox data-src="#modal3" class="popup">Модальное окно</a>--}}

                    <table id="" class="table">
                        <thead>
                        <tr>
                            <th style="width: 40px;">&#8470;</th>
                            <th style="width: 60px;">Дата</th>
                            <th style="width: 200px;">Поставщик</th>
                            <th style="width: 50px;padding-left: 0px!important;text-align: center;">Количество</th>
                            <th style="width: 50px;padding-left: 0px!important;text-align: center;">Сумма</th>
                            <th style="width: 50px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="all-counterparty-tab" class="">
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order['id'] }}</td>
                                <td>{{ $order['created_at'] }}</td>
                                <td>{{ $order['counterparty_id'] }}</td>
                                <td>{{ $order['quantity'] }}</td>
                                <td>{{ $order['sum'] }}</td>
                                <td class="text-center"><a href="#modal" data-toggle="modal" onclick="editCounterparty({{ $order['id'] }})">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a class="col-md-offset-3" href="#" onclick="delCounterparty({{ $order['id'] }})">
                                        <i class="fa fa-trash-o fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <!-- HTML-код модального окна -->
    <div id="modal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="height: 400px;">
                <div class="modal-header" style="text-align: center;">
                    <h4 class="modal-title" style="display: inline-block;">Информация о приходном ордере</h4>
                    <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label for="incoming_payment_order_id" class="col-md-4 control-label">Номер накладной</label>
                    <div class="col-md-6">
                        <input id="incoming_payment_order_id"  class="form-control" name="incoming_payment_order_id" disabled>
                    </div>
                    <label for="counterparty_id" class="col-md-4 control-label">Поставщик</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="counterparty_id">
                                @foreach($counterparties as $counterparty)
                                <option value="{{ $counterparty['id'] }}">{{ $counterparty['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <label for="incoming_payment_order_date" class="col-md-4 control-label">Дата</label>
                    <div class="col-md-6">
                        <input id="incoming_payment_order_date" type="text" class="form-control" name="incoming_payment_order_date" value="{{ old('incoming_payment_order_date') }}" required autofocus>
                    </div>
                    <label for="incoming_payment_order_item" class="col-md-4 control-label">Выбор товаров</label>
                    <div class="col-md-6">
                        {{--<button id="incoming_payment_order_item" class="btn btn-success">Выбрать</button>--}}
                        <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#modal2" onclick="getAllProduct()">Добавить</a>
                    </div>
                    <label for="incoming_payment_order_quantity" class="col-md-4 control-label">Количество товаров</label>
                    <div class="col-md-6">
                        <input id="incoming_payment_order_quantity" type="text" class="form-control" name="incoming_payment_order_quantity" disabled>
                    </div>
                    <label for="incoming_payment_order_summa" class="col-md-4 control-label">Сумма</label>
                    <div class="col-md-6">
                        <input id="incoming_payment_order_summa" type="text" class="form-control" name="incoming_payment_order_summa" disabled>
                    </div>

                    {{-- Таблица товаров в модальном окне--}}
                    <div style="margin-top: 20px">

                    </div>
                    <table id="" class="table">
                        <thead>
                        <tr>
                            <th style="width: 40px;">&#8470;</th>
                            <th style="width: 230px;">Наименование</th>
                            <th style="width: 50px;padding-left: 0px!important;text-align: center;">Кол-во</th>
                            <th style="width: 50px;">Цена</th>
                            <th style="width: 50px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="all-product-tab" class="">
                        {{--@foreach($orders as $order)
                            <tr>
                                <td>{{ $order['id'] }}</td>
                                <td>{{ $order['counterparty_id'] }}</td>
                                <td>{{ $order['quantity'] }}</td>
                                <td>{{ $order['sum'] }}</td>
                                <td class="text-center"><a href="#modal" data-toggle="modal" onclick="editProduct({{ $order['id'] }})">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a class="col-md-offset-3" href="#" onclick="delProduct({{ $order['id'] }})">
                                        <i class="fa fa-trash-o fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach--}}
                        </tbody>
                    </table>
                    {{--Конец таблицы товаров--}}

                    <div class="col-md-4 col-md-offset-8">
                        <button id="" type="submit" form="" class="btn btn-danger" onclick="setCounterparty();">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- HTML-код модального окна -->
<div id="modal2" style="z-index: 9999; " class="modal fade in">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="height: 400px;">
            <div class="modal-header" style="text-align: center;">
                <h4 class="modal-title" style="display: inline-block;">Выберите товары</h4>
                <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                {{ csrf_field() }}
                <table id="" class="table">
                    <thead>
                    <tr>
                        <th style="width: 40px;">&#8470;</th>
                        <th style="width: 150px;">Наименование</th>
                        <th style="width: 30px;padding-left: 0px!important;text-align: center;">Кол-во</th>
                        <th style="width: 30px;">Цена</th>
                        <th style="width: 30px;">Добавить</th>
                    </tr>
                    </thead>
                    <tbody id="all-product-tab" class="">
                   {{-- @foreach($products as $product)
                        <tr>
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>{{ $product['price'] }}</td>
                            <td class="text-center"><a href="#modal" data-toggle="modal" onclick="editProduct({{ $product['id'] }})">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a class="col-md-offset-3" href="#" onclick="delProduct({{ $product['id'] }})">
                                    <i class="fa fa-trash-o fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
