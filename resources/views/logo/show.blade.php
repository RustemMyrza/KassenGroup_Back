@extends('adminlte::page')

@section('title', 'Просмотр блока')

@section('content_header')
    <h1>Просмотр блока</h1>
@stop

@section('content')

    <div class="card-body">

        <a href="{{ url('/admin/logo') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
        <a href="{{ url('/admin/logo/' . $logo->id . '/edit') }}" title="Редактировать блок"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Редактировать</button></a>
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $logo->id }}</td>
                    </tr>
                    <tr><th> Логотип </th><td><img src="{{ $logo->logo ? url($logo->logo) : '' }}" alt="{{ $logo->logo ? url($logo->logo) : '' }}" width="350px;"></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
