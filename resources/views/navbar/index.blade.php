@extends('adminlte::page')

@section('title', 'Навигационное меню')

@section('content_header')
    <h1>Навигационное меню</h1>
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
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($navbar))
                    @foreach($navbar as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name ? Str::limit($translatedData->find($item->name)->ru, 50) : '' }}</td>
                                <td>
                                <a href="{{ url('/admin/navbar/' . $item->id) }}" title="Посмотреть блок"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Просмотр</button></a>
                                    <a href="{{ url('/admin/navbar/' . $item->id . '/edit') }}" title="Редактировать блок">
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
            <div class="pagination-wrapper"> {!! $navbar->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
@endsection
