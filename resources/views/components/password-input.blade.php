@props(['disabled' => false, 'readonly' => false])

<div class="position-relative" x-data="{show:true}">
	<input :type="show ? 'password' : 'text'"
			placeholder="{{ $attributes['placeholder'] }}"
			class="{{ $attributes['class'] }}"
			name="{{ $attributes['name'] }}"
			{{ $attributes->wire('model') }}
			{{ $disabled ? 'disabled' : '' }}
			{{ $readonly ? 'readonly' : ''}}
	>
	<div class="position-absolute end-0 top-50 translate-middle-y me-3">
		<i class="fa-solid fa-eye fs-5 text-dark-emphasis cursor-pointer"
			:class="{'d-none': !show, 'd-block':show }"
			@click="show = !show">
		</i>
		<i class="fa-solid fa-eye-slash fs-5 text-dark-emphasis cursor-pointer"
			:class="{'d-block': !show, 'd-none':show }"
			@click="show = !show">
		</i>
	</div>
</div>
