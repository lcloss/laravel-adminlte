<div class="{{ $groupClass }} {{ $required ? 'required' : '' }}">
    <div class="form-group">
        @if( $label != '' )
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
        @endif
        <select class="form-control {{ $class }} @error( $name ) is-invalid @enderror" @if( $useId ) id="{{ $id }}" @endif name="{{ $name }}" {{ $attributes }}>
            @foreach( $options as $optionValue => $optionLabel )
            <option {{ $isSelected($optionValue) ? 'selected="selected"' : '' }} wire:key="{{ $loop->index }}" value="{{ $optionValue }}">
                {{ $optionLabel }}
            </option>
            @endforeach
        </select>
        @error( $name )
        <div id="{{ $name }}MsgError" class="error invalid-feedback">{{ $message }}</div>
        @enderror
        @if( $helpText != '' )
            <small id="{{ $id }}Help" class="form-text text-muted">{{ $helpText }}</small>
        @endif
    </div>
</div>
