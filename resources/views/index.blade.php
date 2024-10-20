<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    @include('layout.styleGlobal')
    @include('layout.stylePage')
</head>

<body>
    @include('layout.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('layout.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layout.jspage')
    @include('layout.jsglobal')

</body>

</html>
