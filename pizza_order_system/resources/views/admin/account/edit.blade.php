@extends('admin.layout.master')

@section('title','Category List Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-4 offset-8">
                                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white">Return to Home <i class="fa-solid fa-house"></i></button></a>
                                </div>
                            </div>
                            <div class="col-lg-10 offset-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Edit Your Profile</h3>
                                        </div>

                                        <hr>
                                        <form action="{{ route("admin#update",Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-4 offset-1">
                                                    @if (Auth::user()->image==null)
                                                        @if(Auth::user()->gender=='male')
                                                            <img src="{{ asset('admin/images/defaultuserimage.png') }}" class="img-thumbnail shadow-sm"/>
                                                        @else
                                                            <img src="{{ asset('admin/images/defaultuserimagefemale.jpg') }}" class="img-thumbnail shadow-sm"/>
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm">
                                                    @endif

                                                    <div class="mt-2">
                                                        <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror">
                                                        @error('image')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-7">
                                                    <div class="row">
                                                        <div class="col-10 offset-1">
                                                            <div class="form-group">
                                                                <label for="name" class="control-label mb-1">Name</label>
                                                                <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name) }}">
                                                                @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email" class="control-label mb-1">Email</label>
                                                                <input type="text" name="email" id="" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email) }}">
                                                                @error('email')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="phone" class="control-label mb-1">Phone</label>
                                                                <input type="number" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', Auth::user()->phone) }}">
                                                                @error('phone')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="phone" class="control-label mb-1">Gender</label>
                                                                <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
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
                                                                <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" style="min-height:100px;max-height:300px;resize:none;">{{ old('address', Auth::user()->address) }}</textarea>
                                                                @error('address')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="userRole">Role</label>
                                                                <input type="text" name="" id="" class="form-control" value="{{ Auth::user()->role }}" disabled>
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
