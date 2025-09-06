<div class="col-sm-2" id="mySidenav">
    <div class="sidebar bg-dark" id="sidebar">
        <h4 class="text-white">My Sidebar</h4>
        <hr class="border-light">
        <a href="#">🏠 Dashboard</a>
        <a href="#">📦 Products</a>
        <a href="#">👥 Users</a>
        <a href="#">⚙️ Settings</a>
        <a href="#">📞 Contact</a>
        <a href="{{ route('get-all-category') }}"
            class="{{ request()->routeIs('get-all-category') ? 'active' : '' }}">📂 Category</a>
        <a href="{{ route('get-all-product') }}" class="{{ request()->routeIs('get-all-product') ? 'active' : '' }}">📂
            Product</a>

        <a href="{{ route('get-all-blog') }}" class="{{ request()->routeIs('get-all-blog') ? 'active' : '' }}">📂
            Blog</a>
    </div>
</div>
