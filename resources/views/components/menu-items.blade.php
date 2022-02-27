@php
  $user = auth()->user();

  // dd(getPermission());
@endphp

{{-- @if (get) --}}
  <li class="nav-item">
    <!--  menu-open active-->
    <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}" class="nav-link ">
      <i class="nav-icon {{ $item['icon'] }}"></i>
      <p>
        {{ $item['name'] }}
        @if (isset($item['subitems']))
          <i class="right fas fa-angle-left"></i>
        @endif
      </p>
    </a>
    @if (isset($item['subitems']))
        <ul class="nav nav-treeview">
          @foreach ($item['subitems'] as $key => $value)
            @if (getPermission($user->role, $key) || $user->id == 1)
              <li class="nav-item">
                <!-- active -->
                <a href="{{ Route::has($value['route']) ? route($value['route']) : '#' }}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ $value['name'] }}</p>
                </a>
              </li>
            @endif
          @endforeach
        </ul>
    @endif
  </li>
{{-- @endif --}}
