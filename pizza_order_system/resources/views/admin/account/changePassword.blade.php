@extends('admin.layout.master')

@section('title','Category List Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 offset-8">
                                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                                </div>
                            </div>
                            <div class="col-lg-6 offset-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Change Password</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ route('admin#changepassword') }}" method="post" novalidate="novalidate">
                                            @csrf
                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Old Password</label>
                                                <input id="categoryname" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror @if(session('notMatch')) is-invalid @endif" aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                                @error('oldPassword')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                @if (session('notMatch'))
                                                    <small class="text-danger">{{ session('notMatch') }}</small>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">New Password</label>
                                                <input id="categoryname" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Change Password">
                                                @error('newPassword')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Confirm Password</label>
                                                <input id="categoryname" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm change">
                                                @error('confirmPassword')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa-solid fa-key"></i>
                                                    <span id="payment-button-amount">Change Password</span>
                                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection
