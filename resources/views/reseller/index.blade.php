@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Daftar Reseller</h3>

        <a href="{{ route('reseller.create') }}" class="btn btn-primary">
            Tambah Reseller
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Toko</th>
                <th>Wilayah</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($resellers as $reseller)
            <tr>
                <td>{{ $reseller->nama_reseller }}</td>
                <td>{{ $reseller->jenis_toko }}</td>
                <td>{{ $reseller->wilayah }}</td>
                <td>{{ $reseller->alamat }}</td>
                <td>{{ $reseller->no_telepon }}</td>

                {{-- STATUS (KLIK LANGSUNG) --}}
                <td class="text-center">
                    <form action="{{ route('reseller.toggleStatus', $reseller->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                            class="badge {{ $reseller->status == 'Aktif' ? 'bg-success' : 'bg-danger' }}"
                            style="border:none; cursor:pointer;">
                            {{ $reseller->status }}
                        </button>
                    </form>
                </td>

                {{-- AKSI --}}
                <td class="text-center">
                    <form action="{{ route('reseller.destroy', $reseller->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin mau hapus reseller ini?')"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection