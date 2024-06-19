@extends('adminlte::page')

@section('title', 'Whatsapp (Ссылка)')

@section('content_header')
    <h1>Whatsapp (Ссылка)</h1>
@stop
@section('content')
    <div class="card-body">
        @include('flash-message')
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('whatsapp.update') }}" accept-charset="UTF-8" class="form-horizontal"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PATCH')

            <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                <label for="link" class="control-label">{{ 'Ссылка' }}</label>
                <input class="form-control" name="link" type="text" id="link"
                        value="{{ isset($whatsappData->link) ? $whatsappData->link : ''}}">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="{{ 'Сохранить' }}">
            </div>


        </form>
@endsection
