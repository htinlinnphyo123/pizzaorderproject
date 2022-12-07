@extends('admin.layout.master')

@section('title','Category List Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-4 offset-8">
                                    <a href="{{ route('admin#list') }}"><button class="btn bg-dark text-white">Admin List Page<i class="fa-solid fa-house"></i></button></a>
                                </div>
                            </div>
                            <div class="col-lg-10 offset-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <button onclick="history.back()"><i class="fa-solid fa-circle-arrow-left"></i> Back</button>
                                            <h3 class="text-center">Edit Your Profile</h3>
                                        </div>

                                        <hr>
                                        <form action="{{ route('admin#change') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-4 offset-1">
                                                    @if (Auth::user()->image==null)
                                                        <img src="{{ asset('admin/images/defaultuserimage.png') }}" class="img-thumbnail shadow-sm"/>
                                                    @else
                                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm">
                                                    @endif
                                                </div>

                                                <div class="col-7">
                                                    <div class="row">
                                                        <div class="col-10 offset-1">
                                                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                                            <div class="form-group">
                                                                <label for="name" class="control-label mb-1">Name</label>
                                                                <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name) }}" disabled>
                                                                @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email" class="control-label mb-1">Email</label>
                                                                <input type="text" name="email" id="" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email) }}" disabled>
                                                                @error('email')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="phone" class="control-label mb-1">Phone</label>
                                                                <input type="number" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', Auth::user()->phone) }}" disabled>
                                                                @error('phone')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="phone" class="control-label mb-1">Gender</label>
                                                                <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror" disabled>
                                                                    <option value="">Choose your gender ... </option>
                                                                    <option value="male" @if(Auth::user()->gender=='male') selected @endif>Male</option>
                                                                    <option value="female" @if(Auth::user()->gender=='female') selected @endif>Female</option>
                                                                </select>
                                                                @error('gender')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="address" class="control-label mb-1">Address</label>
                                                                <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" style="min-height:100px;max-height:300px;resize:none;" disabled>{{ old('address', Auth::user()->address) }}</textarea>
                                                                @error('address')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="userRole">Role</label>
                                                                <select name="userRole" id="" class="form-control">
                                                                    <option value="" selected disabled>Choose your role</option>
                                                                    <option value="admin" @if(Auth::user()->role=='admin') selected @endif>Admin</option>
                                                                    <option value="user" @if(Auth::user()->role=='user') selected @endif>User</option>
                                                                </select>
                                                            </div>

                                                            <div class="mt-2">
                                                                <button type="submit" class="w-100 btn btn-dark"><i class="fa-solid fa-square-pen"></i> Update Profile</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

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
