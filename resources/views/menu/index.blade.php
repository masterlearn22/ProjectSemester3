@extends('index')

@section('content')
<h1>Daftar Menu</h1>

<a href="{{ route('menu.create') }}" class="btn btn-success">Tambah Menu</a>



@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<table class="table table-dark">
    <thead>
        <tr>
            <th> MENU_ID </th>
            <th> MENU_NAME </th>
            <th> MENU_LINK </th>
            <th> MENU_ICON </th>
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
            <td>
                <!-- Menampilkan akses user yang terkait dari settings -->
                @foreach ($m->settings as $setting)
                    {{ $setting->jenisUser->JENIS_USER ?? 'Tidak Ada Akses' }}
                @endforeach
            </td>                 
            <td>
                <a href="{{ route('menu.edit', $m->MENU_ID) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('menu.destroy', $m->MENU_ID) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<h1>Akses Menu</h1>
    <form action="{{ route('aksesMenu.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Jenis User</label>
                        <select name="ID_JENIS_USER" class="form-select" id="ID_JENIS_USER" required>
                            <option value="">pilih user</option>
                            @foreach ($jenis_user as $item)
                                <option value="{{ $item->ID_JENIS_USER }}">{{ $item->JENIS_USER }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Berikan akses menu ke</label>
                        <select name="MENU_ID" class="form-select" id="menu_id" required>
                            <option value="">Pilih menu</option>
                            @foreach ($allMenu as $menuUser)
                                <option value="{{ $menuUser->MENU_ID }}">{{ $menuUser->MENU_NAME }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </div>
    </form>

@endsection
