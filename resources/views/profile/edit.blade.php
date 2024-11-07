<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')
    <style>
        .current-profile-photo {
            text-align: center;
            margin-bottom: 20px;
        }

        .current-profile-photo img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
            cursor: pointer;
            /* Tambahkan pointer untuk menunjukkan bahwa gambar bisa diklik */
        }

        #profile_photo {
            display: none;
            /* Sembunyikan input file */
        }
    </style>
</head>

<body>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Profile</h4>

                        <!-- Bagian untuk menampilkan foto profil saat ini -->
                        <div class="current-profile-photo">
                            <img id="profileImage"
                                src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('assets/images/faces/default.jpg') }}"
                                alt="Current Profile Photo">
                        </div>

                        <!-- Input file yang tersembunyi -->
                        
                        <form class="forms-sample" action="{{ route('profile.update', $user->ID_USER)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                             <!-- Debug info -->
                           {{ $user->ID_USER }} 
                            <input type="file" name="profile_photo" class="form-control" id="profile_photo">
                            <!-- Form input lainnya -->
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="Username2"
                                        value="{{ old('name', $user->name) }}" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" id="Username2"
                                        value="{{ old('username', $user->username) }}" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email2" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="Email2"
                                        value="{{ old('email', $user->email) }}" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_telp" class="col-sm-3 col-form-label">Nomor Hp</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_hp" class="form-control" id="Mobile"
                                        value="{{ old('no_hp', $user->no_hp) }}" placeholder="Mobile number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="wa" class="col-sm-3 col-form-label">WhatsApp</label>
                                <div class="col-sm-9">
                                    <input type="text" name="wa" class="form-control" id="Mobile"
                                        value="{{ old('wa', $user->wa) }}" placeholder="Mobile number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Password2" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" id="Password2"
                                        placeholder="Password (kosongkan jika tidak diubah)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="ConfirmPassword2" placeholder="Konfirmasi Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    @include('layout.jspage')
    @include('layout.jsglobal')
<script>
      // JavaScript untuk membuka file manager ketika gambar diklik
      document.getElementById('profileImage').onclick = function() {
            document.getElementById('profile_photo').click();
        };

        // Preview gambar yang dipilih langsung ditampilkan
        document.getElementById('profile_photo').onchange = function(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                document.getElementById('profileImage').src = src;
            }
        };
</script>
</body>

</html>
