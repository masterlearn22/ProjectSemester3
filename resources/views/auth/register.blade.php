<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Surya Web</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="flex-grow row">
                    <div class="mx-auto col-lg-4">
                        <div class="p-5 text-left auth-form-light">
                            <div class="brand-logo">
                                <img src="../../assets/images/logo.svg">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form action="simpanregist" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="username"
                                        name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        name="name" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email"
                                        name="email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="no_hp"
                                        name="no_hp" placeholder="Nomor HP">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="wa"
                                        name="wa" placeholder="Whatapps">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="pin"
                                        name="pin" placeholder="PIN">
                                </div>
                                <div class="mb-3">
                                    <select name="ID_JENIS_USER" class="form-control" required>
                                        @foreach ($role as $item)
                                            <option value="{{ $item->ID_JENIS_USER }}">{{ $item->JENIS_USER }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password"
                                        name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Confirm Password">
                                </div>
                                <div class="gap-2 mt-3 d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                                </div>
                                <div class="mt-4 text-center font-weight-light"> Already have an account? <a
                                        href="login" class="text-primary">Login</a></div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="../../assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
</body>

</html>
