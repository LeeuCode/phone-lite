@foreach ($items as $key => $value)
  @php
    $checked = '';
    if (isset($group)) {
      $checked = (getPermission($groupPermission->id, $input.$key)) ? 'checked' : '';
    }
  @endphp
  <div class="form-group">
    <div class="custom-control custom-switch">
      <input type="checkbox" name="{{ $input.$key }}" {!! $checked !!} class="custom-control-input" id="{{ $input.$key }}">
      <label class="custom-control-label" for="{{ $input.$key }}">{{ __($value) }}</label>
    </div>
  </div>
@endforeach
