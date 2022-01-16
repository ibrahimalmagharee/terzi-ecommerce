<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
          content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('/public/assets/front/assets/logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/public/assets/front/assets/logo.png')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/plugins/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/plugins/forms/wizard.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/plugins/forms/wizard.css')}}">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/weather-icons/climacons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/fonts/meteocons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/charts/morris.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/charts/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/forms/selects/select2.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/assets/admin/vendors/css/charts/chartist-plugin-tooltip.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/assets/admin/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/pages/chat-application.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/custom-rtl.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/assets/admin/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/pages/timeline.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/extensions/datedropper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/extensions/timedropper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/plugins/file-uploaders/dropzone.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/css-rtl/category.css')}}">
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('/public/assets/admin/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/assets/admin/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/public/assets/admin/css/dataTables.bootstrap4.min.css')}}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    @yield('style')
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu" data-col="2-columns">
<!-- fixed-top-->

@include('admin.includes.header')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.includes.sidebar')

@yield('content')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.includes.footer')






<!-- BEGIN VENDOR JS-->
<script src="{{asset('/public/assets/admin/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script src="{{asset('/public/assets/admin/vendors/js/tables/datatable/datatables.min.js')}}"
        type="text/javascript"></script>



<script src="{{asset('/public/assets/admin/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"></script>

<script src="{{asset('/public/assets/admin/vendors/js/tables/datatable/dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/admin/vendors/js/tables/jszip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/tables/pdfmake.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/tables/vfs_fonts.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/tables/buttons.html5.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/tables/buttons.print.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/tables/buttons.colVis.min.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/admin/vendors/js/forms/toggle/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/extensions/dropzone.min.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/admin/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/js/scripts/forms/switch.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script>

<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('/public/assets/admin/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/admin/vendors/js/extensions/datedropper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/extensions/timedropper.min.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/admin/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/js/scripts/pages/chat-application.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/admin/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}" type="text/javascript"></script>

<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('/public/assets/admin/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/js/scripts/customizer.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<script src="{{asset('/public/assets/admin/js/scripts/pages/dashboard-crypto.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/vendors/js/editors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/js/scripts/editors/editor-ckeditor.js')}}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL JS-->

<script src="{{asset('/public/assets/admin/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}"
        type="text/javascript"></script>



<script src="{{asset('/public/assets/admin/js/scripts/tables/datatables/datatable-basic.js')}}"
        type="text/javascript"></script>

<script src="{{asset('/public/assets/admin/js/scripts/extensions/date-time-dropper.js')}}" type="text/javascript"></script>

<!-- END PAGE LEVEL JS-->

<script src="{{asset('/public/assets/admin/js/scripts/forms/checkbox-radio.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/admin/js/scripts/modal/components-modal.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/admin/js/toastr.min.js')}}" type="text/javascript"></script>

@yield('script')
<script type="text/javascript">
        @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"


    switch(type){
        case 'info':
            toastr.info("{{Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{Session::get('message') }}");
            break;
    }
    @endif
</script>
<script>
    $('#meridians1').timeDropper({
        meridians: true,
        setCurrentTime: false
    });
    $('#meridians2').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians3').timeDropper({
        meridians: true,
        setCurrentTime: false
    });
    $('#meridians4').timeDropper({
        meridians: true,
        setCurrentTime: false
    });
    $('#meridians5').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians6').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians7').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians8').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians9').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians10').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians11').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians12').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians13').timeDropper({
        meridians: true,setCurrentTime: false
    });
    $('#meridians14').timeDropper({
        meridians: true,setCurrentTime: false
    });
</script>

</body>
</html>
