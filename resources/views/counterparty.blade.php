@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Контрагенты</div>

                    <div class="panel-body">
                        <a href="#modal" class="btn btn-success"  data-toggle="modal" onclick="clearCounterpartyModal()">Добавить</a>
                    </div>

                    <table id="" class="table">
                        <thead>
                        <tr>
                            <th style="width: 40px;">&#8470;</th>
                            <th style="width: 60px;">Тип</th>
                            <th style="width: 200px;">Наименование</th>
                            <th style="width: 50px;padding-left: 0px!important;text-align: center;">Телефон</th>
                            <th style="width: 50px;">Email</th>
                            <th style="width: 50px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="all-counterparty-tab" class="">
                        @foreach($counterparties as $counterparty)
                            <tr>
                                <td>{{ $counterparty['id'] }}</td>
                                @if($counterparty['type'] == 1)
                                    <td class="btn-danger">Покупатель</td>
                                @else
                                    <td class="btn-success">Поставщик</td>
                                @endif
                                <td>{{ $counterparty['name'] }}</td>
                                <td>{{ $counterparty['tel'] }}</td>
                                <td>{{ $counterparty['email'] }}</td>
                                <td class="text-center"><a href="#modal" data-toggle="modal" onclick="editCounterparty({{ $counterparty['id'] }})">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a class="col-md-offset-3" href="#" onclick="delCounterparty({{ $counterparty['id'] }})">
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
        <div class="modal-dialog modal-lg modalInsideEmployee">
            <div class="modal-content" style="height: 400px;">
                <div class="modal-header" style="text-align: center;">
                    <h4 class="modal-title" style="display: inline-block;">Информация о контрагенте</h4>
                    <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input id="counterparty_id" type="hidden" class="form-control" name="counterparty_id">
                    <label for="counterparty_type" class="col-md-4 control-label">Тип контрагента</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select id="counterparty_type">
                                <option value="1">Покупатель</option>
                                <option value="2">Поставщик</option>
                            </select>
                        </div>
                    </div>
                    <label for="counterparty_name" class="col-md-4 control-label">Наименование</label>
                    <div class="col-md-6">
                        <input id="counterparty_name" type="text" class="form-control" name="counterparty_name" value="{{ old('counterparty_name') }}" required autofocus>
                    </div>
                    <label for="counterparty_tel" class="col-md-4 control-label">Телефон</label>
                    <div class="col-md-6">
                        <input id="counterparty_tel" type="text" class="form-control" name="counterparty_tel" value="{{ old('counterparty_tel') }}" required>
                    </div>
                    <label for="counterparty_email" class="col-md-4 control-label">Email</label>
                    <div class="col-md-6">
                        <input id="counterparty_email" type="email" class="form-control" name="counterparty_email" value="{{ old('counterparty_email') }}" required>
                    </div>
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
