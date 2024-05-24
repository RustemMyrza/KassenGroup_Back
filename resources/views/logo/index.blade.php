@extends('adminlte::page')

@section('title', 'Логотип компаний')

@section('content_header')
    <h1>Логотип компаний</h1>
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
                    <th>Логотип компаний</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($logo))
                    @foreach($logo as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ $item->logo ? url($item->logo) : '' }}" alt="" width="350px;"></td>
                                <td>
                                <a href="{{ url('/admin/logo/' . $item->id) }}" title="Посмотреть блок"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Просмотр</button></a>
                                    <a href="{{ url('/admin/logo/' . $item->id . '/edit') }}" title="Редактировать блок">
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
            <div class="pagination-wrapper"> {!! $logo->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
@endsection
