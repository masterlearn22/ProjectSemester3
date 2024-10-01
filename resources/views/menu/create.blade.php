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
        <label for="MENU_ID">Menu ID</label>
        <input type="text" class="form-control" id="MENU_ID" name="MENU_ID" required>
    </div>
    <div class="form-group">
        <label for="MENU_NAME">Nama Menu</label>
        <input type="text" class="form-control" id="MENU_NAME" name="MENU_NAME" required>
    </div>
    <div class="form-group">
        <label for="MENU_LINK">Link Menu</label>
        <input type="text" class="form-control" id="MENU_LINK" name="MENU_LINK" required>
    </div>
    <div class="form-group">
        <label for="MENU_ICON">Icon Menu</label>
        <input type="text" class="form-control" id="MENU_ICON" name="MENU_ICON" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
