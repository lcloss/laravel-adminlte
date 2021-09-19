<div class="{{ $groupClass }} {{ $required ? 'required' : '' }}">
    <div class="form-group">
        @if( $label != '' )
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
        @endif
        @if( $iconAppend != '' )
        <div class="input-group">
            <input type="{{ $type }}" class="form-control {{ $class }} @error( $name ) is-invalid @enderror" @if( $useId ) id="{{ $id }}" @endif name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" {{ $attributes }}>
            <div class="input-group-append">
                <div class="input-group-text">
                    {!! $iconAppend !!}
                </div>
            </div>
        </div>
        @else
        <input type="{{ $type }}" class="form-control {{ $class }} @error( $name ) is-invalid @enderror" @if( $useId ) id="{{ $id }}" @endif name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" {{ $attributes }}>
        @endif
        @error( $name )
        <div id="{{ $name }}MsgError" class="error invalid-feedback">{{ $message }}</div>
        @enderror
        @if( $helpText != '' )
        <small id="{{ $id }}Help" class="form-text text-muted">{{ $helpText }}</small>
        @endif
    </div>
</div>
