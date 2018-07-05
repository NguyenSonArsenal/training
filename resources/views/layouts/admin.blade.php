<!DOCTYPE html>
<html>
<head>
    @include ('include.admin.inc_admin_link')

    @yield('add_link_css_admin')

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include ('include.admin.inc_admin_header')
    @include ('include.admin.inc_admin_sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>

</div>

@include ('include.admin.inc_admin_js')

@yield('script')

</body>
</html>