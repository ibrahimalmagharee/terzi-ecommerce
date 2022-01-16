<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="apple-touch-icon" href="{{asset('/public/assets/front/assets/logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/public/assets/front/assets/logo.png')}}">
    <link rel="stylesheet" href="{{asset('/public/assets/front/css/bootstrap.min.css')}}" />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{asset('/public/assets/front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/public/assets/front/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('/public/assets/front/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('/public/assets/front/css/jquery.dataTables.css')}}"/>
    <link rel="stylesheet" href="{{asset('/public/assets/front/css/style2.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>@yield('title')</title>
</head>
<body>

@yield('content')
<script type="text/javascript" src="{{asset('/public/assets/front/js/dropzone.min.js')}}"></script>
<script src="{{asset('/public/assets/front/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('/public/assets/front/js/jquery.dataTables.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
<script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>
<script src="{{asset('/public/assets/front/js/owl.carousel.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@yield('script')
<script>
    $('.first').owlCarousel({
        autoplay:true,
        rtl:true,
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            }
        }
    })

    $('.second').owlCarousel({
        autoplay:true,
        rtl:true,
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            }
        }
    })
    $('.third').owlCarousel({
        autoplay:true,
        rtl:true,
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            }
        }
    })
</script>

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

</body>
</html>
