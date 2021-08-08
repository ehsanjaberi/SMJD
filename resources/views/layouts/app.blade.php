<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>سامانه مدیریت اساتید و کلاس ها</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!--Icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/persian-datepicker-0.4.5.min.css') }}" />

    @yield('head')
</head>
<body>
<!--Header-->
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow-sm">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo.png') }}" width="30" height="30" alt="" loading="lazy">
        <h6 class="mb-0 mr-1 d-none d-sm-block">مدیریت جامع دانشگاه</h6>
    </a>
    <ul class="navbar-nav ml-auto d-none d-md-block">
        <li>
            <span class="fa fa-bars fa-2x cursor-pointer" onclick="ToggleSideBar()"></span>
        </li>
{{--        <li>--}}
{{--            <form action="">--}}
{{--                <div class="input-group flex-row-reverse">--}}
{{--                    <div class="input-group-prepend">--}}
{{--                        <button type="submit" class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-search"></i></button>--}}
{{--                    </div>--}}
{{--                    <input type="text" class="form-control" placeholder="جستجو" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </li>--}}
    </ul>
    <div>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active dropdown d-flex align-items-center">
                <span>{{ \Illuminate\Support\Facades\Auth::user()->Person->Name.' '.\Illuminate\Support\Facades\Auth::user()->Person->Family }}</span>
                <a class="nav-link c-p" id="userdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user-circle-o" style="font-size: 1.5em"></span></a>
                <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item px-2" href="#">
                        <i class="fa fa-user"></i>
                        حساب کاربری
                    </a>
                    <a class="dropdown-item px-2" href="{{ route('Messenger') }}">
                        <i class="fa fa-envelope-open-o"></i>
                        صندوق پیام
                    </a>
                    <a class="dropdown-item text-danger px-2" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                        <i class="fa fa-sign-out"></i>
                        خروج
                    </a>
                    <form action="{{ route('logout') }}" id="logout-form" method="post" style="display: none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--Sidebar-->
<div id="sidebar" class="sidebar bg-light shadow-lg">
    <div class="border-top">
        <ul class="mb-0 pr-0 pt-1 list-unstyled d-flex justify-content-center nav nav-tabs">
            @foreach($Sub as $sub)
{{--                {{\Illuminate\Support\Facades\Route::current()->getName()}}--}}

                @if($sub->Menu->where('Url',\Illuminate\Support\Facades\Route::current()->getName())->first())
                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="{{ $sub->Title }}">
                        <a class="nav-link active" id="{{ 'tab_'.$sub->Name }}" data-toggle="tab" href="{{ '#'.$sub->Name }}" role="tab" aria-controls="{{$sub->Name}}" aria-selected="true" >
                            <i class="{{ $sub->Icon }}"></i>
                        </a>
                    </li>
                @else
                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="{{ $sub->Title }}">
                        <a class="nav-link" id="{{ 'tab_'.$sub->Name }}" data-toggle="tab" href="{{ '#'.$sub->Name }}" role="tab" aria-controls="{{ $sub->Name }}" aria-selected="false">
                            <i class="{{ $sub->Icon }}"></i>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        @foreach($Sub as $sub)

            @if($sub->Menu->where('Url',\Illuminate\Support\Facades\Route::current()->getName())->first())
                <div id="{{ $sub->Name }}" role="tabpanel" aria-labelledby="{{ 'tab_'.$sub->Name }}" class="tab-pane fade show active list-group list-group-flush text-right">
            @else
                <div id="{{ $sub->Name }}" role="tabpanel" aria-labelledby="{{ 'tab_'.$sub->Name }}" class="tab-pane fade list-group list-group-flush text-right">
            @endif
            @foreach($sub->Menu as $menu)
                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                    @if($Per->PermissionId == $menu->PermissionId)
                        <a href="{{ route($menu->Url) }}" class="list-group-item list-group-item-action bg-light p-2 border-0 {{ (\Illuminate\Support\Facades\Route::current()->getName()==$menu->Url)?'active-menu':'' }}">
                            <i class="{{ $menu->icon }} mx-2"></i>
                            {{ $menu->Title }}
                        </a>
                    @endif
                @endforeach
            @endforeach
            @if($sub->Name=='Reports')
                @foreach($sub->ReportMenu as $rMenu)
                    <a class="d-flex align-items-center list-group-item list-group-item-action bg-light p-2 border-0" data-toggle="collapse" href="{{ '#'. $rMenu->Title }}" role="button" aria-expanded="false" aria-controls="{{ $rMenu->Title }}">
                        <i class="{{ $rMenu->Icon }} mx-2"></i>
                        {{ $rMenu->Name }}
                        <i class="fa fa-caret-down mx-2" style="margin-right: auto!important;"></i>
                    </a>
                    @if($rMenu->Reports)
                        <div class="collapse sub-menu" id="{{ $rMenu->Title }}">
                        @foreach($rMenu->Reports as $report)
                            <a href="{{ route('ShowReport',$report->id) }}" class="list-group-item list-group-item-action bg-light p-2 border-0">
                                <i class="fa fa-file-excel-o mx-2"></i>
                                {{ $report->Title }}
                            </a>
                        @endforeach
                        </div>
                    @endif
                @endforeach
            @endif
            </div>
        @endforeach
    </div>
</div>
<!--Main-Content-->
    <div id="toggleContent">@yield('content')</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{--<script src="node_modules/popper.js/dist/popper.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('js/validation/localization/messages_fa.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!-- babakhani datepicker -->
<script src="{{ asset('js/persian-date-0.1.8.min.js') }}"></script>
<script src="{{ asset('js/persian-datepicker-0.4.5.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
@yield('script')
</body>
</html>
