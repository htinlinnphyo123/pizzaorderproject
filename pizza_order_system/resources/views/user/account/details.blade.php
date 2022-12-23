@extends('user.layouts.master')

@section('title','User Profile')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-lg-9 offset-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <a href="{{ route('user#home') }}" class="text-decoration-none text-dark"><i class="fa-solid fa-arrow-left me-1"></i> Back to Home Page</a>
                                            <h3 class="text-center">Account Info</h3>
                                        </div>
                                        <hr>
                                        @if (session('updateSuccess'))
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong class="text-success"><i class="fa-solid fa-check ms-5 me-2"></i>{{ session('updateSuccess') }}</strong>
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                           </div>
                                       @endif
                                        <div class="row">
                                            <div class="col-3 offset-1">
                                                @if (Auth::user()->image!==null)
                                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm">
                                                @else
                                                    @if(Auth::user()->gender=='male')
                                                        <img src="{{ asset('admin/images/defaultuserimage.png') }}" class="img-thumbnail shadow-sm"/>
                                                    @else
                                                        <img src="{{ asset('admin/images/defaultuserimagefemale.jpg') }}" class="img-thumbnail shadow-sm"/>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <div class="row my-3">
                                                    <h4 class="col-1"><i class="fa-solid fa-user mx-3"></i></h4>
                                                    <h4 class="col-9">{{ Auth::user()->name }}</h4>
                                                </div>
                                                <div class="row my-3">
                                                    <h4 class="col-1"><i class="fa-solid fa-envelope mx-3"></i></h4>
                                                    <h4 class="col-9">{{ Auth::user()->email }}</h4>
                                                </div>
                                                <div class="row my-3">
                                                    <h4 class="col-1"><i class="fa-solid fa-phone mx-3"></i></h4>
                                                    <h4 class="col-9">{{ Auth::user()->phone }}</h4>
                                                </div>
                                                <div class="row my-3">
                                                    <h4 class="col-1"><i class="fa-solid fa-location-dot ml-3"></i></h4>
                                                    <h4 class="col-9">{{ Auth::user()->address }}</h4>
                                                </div>
                                                <div class="row my-3">
                                                    <h4 class="col-1"><i class="fa-solid fa-mars-and-venus mx-3"></i></h4>
                                                    <h4 class="col-9">{{ Auth::user()->gender }}</h4>
                                                </div>
                                                <div class="row my-3">
                                                    <h4 class="col-1"><i class="fa-solid fa-calendar mx-3"></i></h4>
                                                    <h4 class="col-9">{{ Auth::user()->created_at->format('d F Y') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-grid">
                                            <a href="{{ route('user#updatePage') }}" class="w-100 btn btn-secondary py-2"><i class="fa-solid fa-user-pen me-2"></i>Edit Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection
