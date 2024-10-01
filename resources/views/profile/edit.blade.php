<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')

</head>

<body>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Profie</h4> 
                    
                    <form class="forms-sample" action="{{ route('profile.update') }}" method="POST">
                      @csrf
                      <div class="form-group row">
                          <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                          <div class="col-sm-9">
                              <input type="text" name="name" class="form-control" id="Username2" value="{{ old('name', $user->name) }}" placeholder="Nama Lengkap" required>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Username" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                              <input type="text" name="username" class="form-control" id="Username2" value="{{ old('username', $user->username) }}" placeholder="Username" required>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Email2" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                              <input type="email" name="email" class="form-control" id="Email2" value="{{ old('email', $user->email) }}" placeholder="Email" required>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="no_telp" class="col-sm-3 col-form-label">Nomor Hp</label>
                          <div class="col-sm-9">
                              <input type="text" name="no_hp" class="form-control" id="Mobile" value="{{ old('no_hp', $user->no_hp) }}" placeholder="Mobile number">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="wa" class="col-sm-3 col-form-label">WhatsApp</label>
                          <div class="col-sm-9">
                              <input type="text" name="wa" class="form-control" id="Mobile" value="{{ old('wa', $user->wa) }}" placeholder="Mobile number">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="Password2" class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                              <input type="password" name="password" class="form-control" id="Password2" placeholder="Password (kosongkan jika tidak diubah)">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="ConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                          <div class="col-sm-9">
                              <input type="password" name="password_confirmation" class="form-control" id="ConfirmPassword2" placeholder="Konfirmasi Password">
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

    @include('layout.jspage')
    @include('layout.jsglobal')

</body>

</html>
