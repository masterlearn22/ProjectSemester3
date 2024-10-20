@extends('index')

@section('content')
<h1>Tambah Menu</h1>
<a class="btn btn-info" href="https://demo.bootstrapdash.com/purple-new/themes/vertical-light/pages/icons/mdi.html" target="_blank">
    Cek icon yang tersedia
</a>
<hr>

<form action="{{ route('menu.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="MENU_NAME">Nama Menu</label>
        <input type="text" class="form-control" id="MENU_NAME" name="MENU_NAME" required>
    </div>
    <div class="form-group">
        <label for="MENU_LINK">Link Menu</label>
        <select class="form-control" id="MENU_LINK" name="MENU_LINK" required>
            <option value="">-- Pilih Route --</option>
            @foreach($routes as $route)
                <option value="{{ $route }}">{{ $route }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="MENU_ICON">Icon Menu</label>
        <input type="text" class="form-control" id="MENU_ICON" name="MENU_ICON" required>
    </div>

    <div class="form-group">
        <label for="roles">Pilih Role yang bisa akses menu ini:</label>
        <div>
            @foreach($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->ID_JENIS_USER }}" 
                    id="role_{{ $role->ID_JENIS_USER }}"
                    {{ in_array($role->ID_JENIS_USER, $selectedRoles) ? 'checked' : '' }}>
                    <label class="form-check-label" for="role_{{ $role->ID_JENIS_USER }}">
                        {{ $role->JENIS_USER }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
