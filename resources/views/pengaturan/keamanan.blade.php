@extends('layouts.app')

@section('content')

<div class="settings-page">

    <div class="settings-header">
        <h2>Kata Sandi & Keamanan</h2>
    </div>

    <div class="settings-card">

    {{-- HEADER CLICKABLE --}}
    <div class="settings-item toggle-password" onclick="togglePasswordForm()">
        <div class="item-left">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Ubah Kata Sandi</span>
        </div>
        <i id="arrowIcon" class="fa-solid fa-chevron-right"></i>
    </div>

    {{-- FORM (HIDDEN DEFAULT) --}}
    <div id="passwordForm" class="password-form">
        <div class="form-group">
            <label>Kata Sandi Saat Ini</label>
            <input type="password" class="form-control" placeholder="Masukkan Kata Sandi Saat Ini">
        </div>

        <div class="form-group">
            <label>Kata Sandi Baru</label>
            <input type="password" class="form-control" placeholder="Masukkan Kata Sandi Baru">
        </div>

        <div class="form-group">
            <label>Verifikasi Kata Sandi Baru</label>
            <input type="password" class="form-control" placeholder="Tulis Ulang Kata Sandi Baru">
        </div>

        <button class="btn btn-primary mt-2">Ubah Kata Sandi</button>
    </div>

</div>


</div>

@endsection