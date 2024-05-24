@extends('adminlte::page')

@section('title', 'Главная страница')

@section('content_header')
    <h1>Главная страница</h1>
@stop

@section('content')

    <div class="card-body">
        @include('flash-message')
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Заголовок</th>
                    <th>Описание</th>
                    <th>Изображение</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($pageContent))
                    @foreach($pageContent as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title ? Str::limit($translatedData->find($item->title)->ru, 50) : '' }}</td>
                                <td>{{ $item->content ? Str::limit($translatedData->find($item->content)->ru, 50) : '' }}</td>
                                <td><img src="{{ $item->image ? url($item->image) : '' }}" alt="" width="200px;"></td>
                                <td>
                                <a href="{{ url('/admin/page/main/' . $item->id) }}" title="Посмотреть блок"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Просмотр</button></a>
                                    <a href="{{ url('/admin/page/main/' . $item->id . '/edit') }}" title="Редактировать блок">
                                        <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"
                                                                                aria-hidden="true"></i> Редактировать
                                        </button>
                                    </a>
                                </td>
                            </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $pageContent->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
@endsection
