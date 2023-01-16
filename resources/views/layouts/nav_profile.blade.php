

<ul class="d-flex align-items-center">
@guest
    @if (Route::has('login'))
        <li class="nav-item me-4">
            <a style="color: black" class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
        </li>
    @endif

    {{-- @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
    @endif --}}
@else
    <li class="nav-item dropdown me-4">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" 
        role="button" data-bs-toggle="dropdown" style="color: black"
        aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>
        
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="ms-4" href="{{route('logout')}}">Đăng xuất</a>
        </div>
    </li>
@endguest
</ul>
