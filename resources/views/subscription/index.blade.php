@extends('adminlte::page')

@section('title', 'Подписки')

@section('content_header')
    <h1>Подписки</h1>
@stop

@section('content')

    <div class="card-body">
        @include('flash-message')

        <form method="GET" action="{{ url('/admin/form/data/subscription') }}" accept-charset="UTF-8"
              class="form-inline my-2 my-lg-0 float-right" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Поиск..."
                       value="{{ request('search') }}">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>

        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Электронная почта</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($subscriptions))
                    @foreach($subscriptions as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->email ? Str::limit($item->email, 50) : '' }}</td>
                                <td>
                                <a href="{{ url('/admin/form/data/subscription/' . $item->id) }}" title="Посмотреть блок"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Просмотр</button></a>

                                    <form method="POST" action="{{ url('/admin/form/data/subscription/' . $item->id) }}"
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
            <div class="pagination-wrapper"> {!! $subscriptions->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
@endsection
