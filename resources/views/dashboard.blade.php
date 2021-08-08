@extends('layouts.app')
@section('content')
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>داشبورد</h5>
        </section>
        <section class="content-body py-3">
            <div class="row">
                <div class="col-xl-3 col-lg-6 mb-2">
                    <div class="card border-0 shadow-sm shadow-hover text-right bg-light">
                        <div class="card-body d-flex">
                            <div>
                                <div class="circle bg-primary rounded-circle d-flex align-self-center ml-3">
                                    <i class="fa fa-users text-white align-self-center mx-auto lead"></i>
                                </div>
                            </div>
                            <div>
                                <h5>{{ \App\Models\User::count() }}</h5>
                                <small id="getuser" class="text-muted" style="font-size: 15px;">تعداد کاربران</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-2">
                    <div class="card border-0 shadow-sm shadow-hover text-right bg-light">
                        <div class="card-body d-flex">
                            <div>
                                <div class="circle bg-info rounded-circle d-flex align-self-center ml-3">
                                    <i class="fa fa-graduation-cap text-white align-self-center mx-auto lead"></i>
                                </div>
                            </div>
                            <div>
                                <h5>{{ \App\Models\Base_UniversityStudents::count() }}</h5>
                                <small id="getuser" class="text-muted" style="font-size: 15px;">تعداد دانشجویان</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-2">
                    <div class="card border-0 shadow-sm shadow-hover text-right bg-light">
                        <div class="card-body d-flex">
                            <div>
                                <div class="circle bg-danger rounded-circle d-flex align-self-center ml-3">
                                    <i class="fa fa-users text-white align-self-center mx-auto lead"></i>
                                </div>
                            </div>
                            <div>
                                <h5>{{ \App\Models\Base_UniversityEmployees::count() }}</h5>
                                <small id="getuser" class="text-muted" style="font-size: 15px;">تعداد کارمندان</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-2">
                    <div class="card border-0 shadow-sm shadow-hover text-right bg-light">
                        <div class="card-body d-flex">
                            <div>
                                <div class="circle bg-success rounded-circle d-flex align-self-center ml-3">
                                    <i class="fa fa-calendar-times-o text-white align-self-center mx-auto lead"></i>
                                </div>
                            </div>
                            <div>
                                <h5>{{ \App\Models\Base_Classes::where('ClassStatus',0)->count() }}</h5>
                                <small id="getuser" class="text-muted" style="font-size: 15px;">کلاس های فعال</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
