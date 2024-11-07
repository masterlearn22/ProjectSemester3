<!-- index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')
    <style>
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info img {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
        }
        .table-profile {
            width: 10%;
            border-collapse: collapse;
        }
        .table-profile th, .table-profile td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profil Saya</h4>
                        
                        <!-- Tampilkan informasi profil pengguna -->
                        <table class="table-profile">
                            <tr>
                                <th>Foto Profil</th>
                                <td>
                                    @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Current Profile Photo" width="100" height="100">
                                    @else
                                        <img src="{{ asset('assets/images/faces/default.jpg') }}" width="100" height="100">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Hp</th>
                                <td>{{ $user->no_hp }}</td>
                            </tr>
                            <tr>
                                <th>WhatsApp</th>
                                <td>{{ $user->wa }}</td>
                            </tr>
                        </table>
                        
                        <!-- Tombol untuk mengedit profil -->
                        <a href="{{ route('profile.edit', $user->ID_USER) }}" class="btn btn-primary">Edit Profil</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.jspage')
    @include('layout.jsglobal')

</body>

</html>