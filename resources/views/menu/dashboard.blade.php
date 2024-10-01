@extends('index')

@section('content')

@if (Auth::user()->ID_JENIS_USER== 1)
<h1>ini dasboard user</h1>
@endif

@if (Auth::user()->ID_JENIS_USER== 2)
<h1>ini dasboard mahasiswa</h1>
@endif

@if (Auth::user()->ID_JENIS_USER== 4)
<h1>INI DASHBOARD SULTAN</h1>
@endif

@endsection