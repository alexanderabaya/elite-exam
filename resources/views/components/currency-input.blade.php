<div x-data>
    <div class="input-group {!! $attributes->whereStartsWith('class')->first() !!}">
        <span class="input-group-text">PHP</span>
        <input x-mask:dynamic="$money($input)" {{ $attributes->wire('model') }}
        {{ $attributes['disabled'] ? 'disabled' : '' }} {{ $attributes['readonly'] ? 'readonly' : '' }} class="form-control"  placeholder="{!! $attributes->whereStartsWith('placeholder')->first() !!}" name="{!! $attributes->whereStartsWith('name')->first() !!}">
    </div>
</div>
