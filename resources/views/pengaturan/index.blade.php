@extends('layouts.app')

@section('content')

<div class="settings-wrapper">

    {{-- HEADER PROFIL --}}
    <div class="profile-card">
        <img src="{{ asset('images/avatar.jpeg') }}" class="profile-avatar">

        <div class="profile-info">
            <h4>Adalah Pokoknya</h4>
            <p>owner@gmail.com</p>
        </div>

        <span class="role">Owner</span>
    </div>

    {{-- PROFIL --}}
    <h3 class="section-title">Profil</h3>

    <div class="settings-card">
        <a href="#" class="settings-item">
            <i class="fa-regular fa-user"></i>
            <span>Info Profil</span>
            <i class="fa-solid fa-chevron-right"></i>
        </a>
    </div>

    {{-- PENGATURAN AKUN --}}
    <h3 class="section-title">Pengaturan Akun</h3>

    <div class="settings-card">

        <a href="{{ url('/pengaturan/keamanan') }}" class="settings-item">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Kata Sandi & Keamanan</span>
            <i class="fa-solid fa-chevron-right"></i>
        </a>

        {{-- BAHASA --}}
        <a href="#" class="settings-item language-item">
            <div class="left">
                <i class="fa-solid fa-globe"></i>
                <span>Bahasa</span>
            </div>

            <div class="right">
                <span class="badge-language">Indonesia</span>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="#" class="settings-item">
            <i class="fa-solid fa-headset"></i>
            <span>Bantuan</span>
            <i class="fa-solid fa-chevron-right"></i>
        </a>

        <a href="#" class="settings-item">
            <i class="fa-regular fa-circle-question"></i>
            <span>Tentang</span>
            <i class="fa-solid fa-chevron-right"></i>
        </a>

    </div>

</div>

@endsection