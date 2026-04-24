<div class="sidebar">

    {{-- LOGO --}}
    <img src="{{ url('images/LogoBrasilMerah.png') }}" 
     alt="Logo" 
     style="max-width:130px;">

    {{-- MENU --}}
    <ul class="menu">
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard">Dashboard</a>
        </li>

        <li class="{{ request()->is('produk*') ? 'active' : '' }}">
            <a href="/produk">Produk</a>
        </li>

        <li class="{{ request()->is('stok*') ? 'active' : '' }}">
            <a href="/stok">Stok</a>
        </li>

        <li class="{{ request()->is('pesanan*') ? 'active' : '' }}">
            <a href="/pesanan">Pesanan</a>
        </li>

        <li class="{{ request()->is('reseller*') ? 'active' : '' }}">
            <a href="/reseller">Reseller</a>
        </li>

        <li class="{{ request()->is('statistik*') ? 'active' : '' }}">
            <a href="/statistik">Statistik</a>
        </li>
    </ul>

</div>
