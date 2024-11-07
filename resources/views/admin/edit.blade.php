<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')

</head>

<body>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('admin.update', $admin->ID_USER) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="exampleInputName1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control"required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" name="username" value="{{ old('username', $admin->username) }}" class="form-control"required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">email</label>
                        <input type="text" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required>
                    </div>                    
                    <div class="form-group">
                        <label>Role</label>
                        <select name="ID_JENIS_USER" class="form-control" required>
                            @foreach ($role as $r)
                                <option value="{{ $r->ID_JENIS_USER }}"
                                    {{ $admin->ID_JENIS_USER == $r->ID_JENIS_USER ? 'selected' : '' }}>
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

</body>

</html>
