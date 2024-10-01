<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')

</head>

<body>

    {{-- <div class="container-fluid page-body-wrapper">

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <nav aria-label="breadcrumb">
                        <form action="{{ route('admin.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="wa" class="form-label">WhatsApp</label>
                                <input type="text" name="wa" value="{{ old('wa', $user->wa) }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="pin" class="form-label">PIN</label>
                                <input type="text" name="pin" value="{{ old('pin', $user->pin) }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="ID_JENIS_USER" class="form-control" required>
                                    @foreach ($role as $r)
                                        <option value="{{ $r->ID_JENIS_USER }}"
                                            {{ $user->ID_JENIS_USER == $r->ID_JENIS_USER ? 'selected' : '' }}>
                                            {{ $r->JENIS_USER }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    </nav>
                </div>
            </div>

        </div>
    </div> --}}
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('admin.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="exampleInputName1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control"required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control"required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">email</label>
                        <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                    </div>                    
                    <div class="form-group">
                        <label>Role</label>
                        <select name="ID_JENIS_USER" class="form-control" required>
                            @foreach ($role as $r)
                                <option value="{{ $r->ID_JENIS_USER }}"
                                    {{ $user->ID_JENIS_USER == $r->ID_JENIS_USER ? 'selected' : '' }}>
                                    {{ $r->JENIS_USER }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="mr-2 btn btn-success">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    @include('layout.jspage')
    @include('layout.jsglobal')

</body>

</html>
