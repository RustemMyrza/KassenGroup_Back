<label for="image" class="control-label">{{ 'Тип партнера' }}</label>
<br>
<select name="type" id="type">
    <option value="1" {{ isset($partner) ? $partner->type == 1 ? 'selected' : '' : '' }}>Экспедиторская перевозка</option>
    <option value="2" {{ isset($partner) ? $partner->type == 2 ? 'selected' : '' : '' }}>Порты</option>
    <option value="3" {{ isset($partner) ? $partner->type == 3 ? 'selected' : '' : '' }}>Контроль</option>
</select>

<br>
<br>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Логотип' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ isset($partner->image) ? url($partner->image) : ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
@if (isset($partner->image))
    <div class="form-group">
        <img src="{{ isset($partner->image) ? url($partner->image) : ''}}" alt="" width="300px;">
    </div>
@endif


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>