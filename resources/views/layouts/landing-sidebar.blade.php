<div class="list-group">
    <a href="{{ route('home') }}"
        class="list-group-item list-group-item-action{{ request()->routeIs('home') ? ' active' : '' }}"
        aria-current="true">
        Dashboard
    </a>
    <a href="{{ route('user.products.index') }}"
        class="list-group-item list-group-item-action{{ request()->routeIs('user.products.*') ? ' active' : '' }}"
        aria-current="true">
        Products
    </a>
</div>
