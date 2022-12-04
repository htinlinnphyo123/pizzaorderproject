@extends('admin.layout.master')

@section('title','Product Create')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 offset-8">
                                    <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">Return to Pizza List</button></a>
                                </div>
                            </div>
                            <div class="col-lg-8 offset-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Create your product</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ route('product#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Pizza Name</label>
                                                <input type="text" name="pizzaName" id="" class="form-control @error('pizzaName') is-invalid @enderror" placeholder="Enter your pizza name ..." value="{{ old('pizzaName') }}">
                                                @error('pizzaName')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Category Name</label>
                                                <select name="categoryName" id="" class="form-control @error('categoryName') is-invalid @enderror">
                                                    <option value="">Choose your category</option>
                                                    @foreach ($category as $c)
                                                        <option value="{{ $c->id }}" @if(old('categoryName')) selected @endif>{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('categoryName')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="pizzaDescription" id="" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="20" rows="10" style="resize:none;">{{ old('pizzaDescription') }}</textarea>
                                                @error('pizzaDescription')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Price</label>
                                                <input type="number" name="pizzaPrice" id="" class="form-control @error('pizzaPrice') @enderror" placeholder="Eg : 2000" value="{{ old('pizzaPrice') }}"/>
                                                @error('pizzaPrice')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Waiting Time</label>
                                                <input type="number" name="waitingTime" id="" class="form-control" @error('waitingTime') is-invalid @enderror placeholder="Enter your waiting time" value="{{ old('waitingTime') }}">
                                                @error('waitingTime')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <input type="file" name="pizzaImage" id="" class="form-control @error('pizzaImage') is-invalid @enderror">
                                                @error('pizzaImage')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="w-100">
                                                <button type="submit" class="btn btn-dark w-100">Create Pizza <i class="fa-solid fa-circle-arrow-right"></i></button>
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
