@extends('adminlte::page')

@section('title', 'Просмотр блока')

@section('content_header')
    <h1>Просмотр блока</h1>
@stop

@section('content')

    <div class="card-body">

        <a href="{{ url('/admin/partner') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
        <a href="{{ url('/admin/partner/' . $partner->id . '/edit') }}" title="Редактировать блок"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Редактировать</button></a>

        <form method="POST" action="{{ url('admin/partner/' .  $partner->id) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm" title="Удалить блок" onclick="return confirm(&quot;Удалить?&quot;)"><i class="fa fa-trash-alt" aria-hidden="true"></i> Удалить</button>
        </form>
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $partner->id }}</td>
                    </tr>
                    <tr><th> Логотип </th><td> <img src="{{ $partner->image ? url($partner->image) : '' }}" alt="{{ $partner->image ? url($partner->image) : '' }}" width="200px;"> </td></tr>
                    <tr><th> Тип партнера </th>
                    <td>
                        @if ($partner->type == 1)
                            Экспедиторская перевозка
                        @elseif ($partner->type == 2)
                            Порты
                        @elseif ($partner->type == 3)
                            Контроль
                        @endif 
                    </td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

