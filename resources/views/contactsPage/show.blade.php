@extends('adminlte::page')

@section('title', 'Просмотр блока')

@section('content_header')
    <h1>Просмотр блока</h1>
@stop

@section('content')

    <div class="card-body">

        <a href="{{ url('/admin/page/contacts') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
        <a href="{{ url('/admin/page/contacts/' . $id . '/edit') }}" title="Редактировать блок"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Редактировать</button></a>
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $id }}</td>
                    </tr>
                    <tr><th> Заголовок </th><td> {{ $translatedData['title']->ru }} </td></tr>
                    <tr><th> Описание </th><td> {{ $translatedData['content']->ru }} </td></tr>
                    <tr><th> Изображение </th><td><img src="{{ $image ? url($image) : '' }}" alt="{{ $image ? url($image) : '' }}" width="200px;"></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
