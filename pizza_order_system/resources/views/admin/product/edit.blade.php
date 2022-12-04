@extends('admin.layout.master')

@section('title','Edit Pizza Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-lg-10 offset-1">
                                <div class="card shadow rounded-5">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <button type="button" onclick="history.back()"><i class="fa-solid fa-circle-left"></i> Back</button>
                                            <h3 class="text-center title-2">Edit your pizza</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ route('product#update') }}" method="post" class="mt-2" novalidate="novalidate" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <div class="row">
                                                <div class="col-5">
                                                    <img src="{{ asset('storage/'.$product->image) }}" alt="" class="mb-3">
                                                    <a href="{{ route('product#detail',$product->id) }}" class="btn btn-dark w-100 mb-2">
                                                        Go to Details
                                                    </a>
                                                    <input type="submit" value="Update Pizza" class="btn btn-dark w-100">
                                                </div>
                                                <div class="col-7">
                                                    <div class="form-group">
                                                        <label for="">Pizza Name</label>
                                                        <input type="text" name="pizzaName" id="" class="form-control @error('pizzaName') is-invalid @enderror" placeholder="Enter your pizza name ..." value="{{ old('pizzaName',$product->name) }}">
                                                        @error('pizzaName')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Category Name</label>
                                                        <select name="categoryName" id="" class="form-control @error('categoryName') is-invalid @enderror">
                                                            <option value="">Choose your category</option>
                                                            @foreach ($category as $c)
                                                                <option value="{{ $c->id }}" @if($product->category_id==$c->id) selected @endif>{{ $c->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('categoryName')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Description</label>
                                                        <textarea name="pizzaDescription" id="" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="20" rows="10" style="resize:none;">{{ old('pizzaDescription',$product->description) }}</textarea>
                                                        @error('pizzaDescription')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Price</label>
                                                        <input type="number" name="pizzaPrice" id="" class="form-control @error('pizzaPrice') @enderror" placeholder="Eg : 2000" value="{{ old('pizzaPrice',$product->price) }}"/>
                                                        @error('pizzaPrice')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Waiting Time (Minute)</label>
                                                        <input type="number" name="waitingTime" id="" class="form-control" @error('waitingTime') is-invalid @enderror placeholder="Enter your waiting time" value="{{ old('waitingTime',$product->waiting_time) }}">
                                                        @error('waitingTime')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>View Count</label>
                                                        <input type="text" name="viewCount" id="" value="{{ $product->view_count }} @if($product->view_count==0) view @else views @endif" class="form-control text-right" disabled>
                                                    </div>
                                                    <p class="mb-2">Change Photo</p>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                          <input type="file" name="pizzaImage" class="custom-file-input @error('pizzaImage') is-invalid @enderror" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                          <label class="custom-file-label" for="inputGroupFile01">Change your photo(opitional)</label>
                                                        </div>
                                                    </div>
                                                    @error('pizzaImage')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
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
