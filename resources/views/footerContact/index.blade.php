@extends('adminlte::page')

@section('title', 'Текст контакта Footer')

@section('content_header')
    <h1>Текст контакта Footer</h1>
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
                    <th>Текст контакта</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($contactText))
                    @foreach($contactText as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->text ? Str::limit($translatedData->find($item->text)->ru, 50) : '' }}</td>
                                <td>
                                <a href="{{ url('/admin/footer-contact/' . $item->id) }}" title="Посмотреть блок"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Просмотр</button></a>
                                    <a href="{{ url('/admin/footer-contact/' . $item->id . '/edit') }}" title="Редактировать блок">
                                        <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"
                                                                                aria-hidden="true"></i> Редактировать
                                        </button>
                                    </a>
                                    <form method="POST" action="{{ url('/admin/footer-contact/' . $item->id) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Удалить блок"
                                                onclick="return confirm(&quot;Удалить?&quot;)"><i class="fa fa-trash-alt"
                                                                                                aria-hidden="true"></i>
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $contactText->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
@endsection
