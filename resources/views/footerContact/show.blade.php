@extends('adminlte::page')

@section('title', 'Просмотр блока')

@section('content_header')
    <h1>Просмотр блока</h1>
@stop

@section('content')
    <div class="card-body">

        <a href="{{ url('/admin/footer-contact') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
        <a href="{{ url('/admin/footer-contact/' . $contactText->id . '/edit') }}" title="Редактировать блок"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Редактировать</button></a>
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $contactText->id }}</td>
                    </tr>
                    <tr><th> Текст контакта </th><td> {{ $translatedText->ru }} </td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
