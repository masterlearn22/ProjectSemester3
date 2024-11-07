@extends('index')

@section('content')
<h1>Daftar Menu</h1>

<a href="{{ route('menu.create') }}" class="btn btn-success">Tambah Menu</a>



@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<table class="table table-dark" >
    <thead>
        <tr>
            <th> MENU_ID </th>
            <th> MENU_NAME </th>
            <th> MENU_LINK </th>
            <th> MENU_ICON </th>
            <th>Pembuat</th>
            <th>Akses User</th>
            <th> Aksi </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menu as $m)
        <tr>
            <td>{{ $m->MENU_ID }}</td>
            <td>{{ $m->MENU_NAME }}</td>
            <td>{{ $m->MENU_LINK }}</td>
            <td>{{ $m->MENU_ICON }}</td>
            <td>{{ $m->CREATE_BY }}</td>
            <td>
                <!-- Menampilkan akses user yang terkait dari settings -->
                @foreach ($m->settings as $setting)
                    {{ $setting->jenisUser->JENIS_USER ?? 'Tidak Ada Akses' }}
                @endforeach
            </td>                 
            <td>
                <a href="{{ route('menu.edit', $m->MENU_ID) }}" class="btn btn-light">Edit</a>
                <form action="{{ route('menu.destroy', $m->MENU_ID) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-dark">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
