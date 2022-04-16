<div class="list-group">
    <a href="{{ route('admin.home') }}"
        class="list-group-item list-group-item-action{{ request()->routeIs('admin.home') ? ' active' : '' }}"
        aria-current="true">
        Home Page
    </a>
    <a href="{{ route('admin.products.index') }}"
        class="list-group-item list-group-item-action{{ request()->routeIs('admin.products.*') ? ' active' : '' }}"
        aria-current="true">
        Products
    </a>
    <a href="{{ route('admin.categories.index') }}"
        class="list-group-item list-group-item-action{{ request()->routeIs('admin.categories.*') ? ' active' : '' }}"
        aria-current="true">
        Categories
    </a>
</div>
