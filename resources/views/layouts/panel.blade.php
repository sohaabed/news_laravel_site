<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Your Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="icon" href="{{asset('admin_panel/images/Capture.ico')}}" type="image/x-icon">


    <link href="{{asset('admin_panel/plugins/summernote/summernote-lite.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->

    <link href="{{ asset('admin_panel/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <!-- dropzone.css -->
    <link href="{{ asset('admin_panel/css/dropzone.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin_panel/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('admin_panel/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('admin_panel/plugins/morrisjs/morris.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('admin_panel/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->


    <link href="{{ asset('admin_panel/css/themes/all-themes.min.css')}}" rel="stylesheet" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


    <style>
        a:hover {
            color: red;
        }

        .material-icons:hover {
            opacity: 100% !important;
        }

        .add:hover {
            opacity: 100% !important;
        }

        .search:hover {
            opacity: 100% !important;
        }

        #delete {
            opacity: 100% !important;
        }

        span.page-link {
            background: red !important;
            border: white !important;
            opacity: 85%;
            color: white !important;
        }
        .footer:hover{
            background: white !important;
          
           
            color: tomato !important;
        }

        .clearfix {
            clear: both;
        }
    </style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->




    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">ADMINBSB - MATERIAL DESIGN</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">

                    <li class="userName" style="color: white;">
                        <h3>Admin | </h3>
                    </li>


                    <li>
                        <a href="#" style="border-bottom: solid 1px white; color:white;margin-left: 5px;" onclick="document.querySelector('.logout').submit()"> Logout </a>
                        <form action="{{route('logout')}}" method="post" class='logout'>


                            @csrf

                        </form>
                    </li>

                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void({{$count=0}});" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            
                            <span class="label-count">
                            @foreach(Auth::user()->notifications as $not)
                            
                            @if($not->unread()) 
                            {{++$count}}
                            @endif
                            @endforeach
                        </span>
                       
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    @foreach(Auth::user()->notifications as $not)
                                   
                           
                                    <li   >
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-red">
                                                <i class="material-icons" style="color: red;">notifications</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4 @if($not->unread()) 
                             style="color:tomato"  @endif  > {{$not->data['body']}} <b>{{$not->data['auther']}}</b></h4>
                                                
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                  
                                   
                                </ul>
                            </li>
                            <li class="footer" >
                                <a href="{{route('admin.notification')}}" style="background:tomato">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->


                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{asset('admin_panel/images/user.png')}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email"> {{Auth::user()->email}} </div>

                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="{{ Route::is('admin.home.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.home.')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.category.*') ? 'active' : '' }} ">
                        <a href="{{route('admin.category.index')}}" class="menu-toggle">
                            <i class="material-icons">list</i>
                            <span>Category</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('admin.category.create')}}">Add Category</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Route::is('admin.content.*') ? 'active' : '' }}">
                        <a href="{{route('admin.content.index')}}" class="menu-toggle">
                            <i class="material-icons">edit</i>
                            <span>Content</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('admin.content.create')}}">Add content</a>
                            </li>
                        </ul>

                    </li>

                    <li class="{{ Route::is('admin.notification') ? 'active' : '' }}">
                        <a href="{{route('admin.notification')}}">
                            <i class="material-icons">notifications</i>
                            <span>Notifications</span>
                        </a>
                    </li>

                </ul>
            </div>

        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    {{$slot}}

    <!-- Jquery Core Js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="{{asset('admin_panel/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('admin_panel/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('admin_panel/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('admin_panel/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('admin_panel/plugins/node-waves/waves.js')}}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('admin_panel/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{asset('admin_panel/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/morrisjs/morris.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{asset('admin_panel/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('admin_panel/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('admin_panel/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>




    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{asset('admin_panel/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('admin_panel/plugins/node-waves/waves.js')}}"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="{{asset('admin_panel/plugins/sweetalert/sweetalert.min.js')}}"></script>




    <!-- Custom Js -->
    <script src="{{asset('admin_panel/js/admin.js')}}"></script>
    <script src="{{asset('admin_panel/js/pages/index.js')}}"></script>

    <!-- Demo Js -->
    <script src="{{asset('admin_panel/js/demo.js')}}"></script>
    <script src="{{asset('admin_panel/js/dropzone.js')}}"></script>
    <script src="{{asset('admin_panel/js/pages/ui/dialogs.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <script src="{{asset('admin_panel/plugins/summernote/summernote-lite.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    <script>
        $('#summernote').summernote({
            placeholder: 'Write the content!!',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]

            ]
        });
    </script>
    <script>
        $('select').selectpicker();
    </script>


</body>

</html>