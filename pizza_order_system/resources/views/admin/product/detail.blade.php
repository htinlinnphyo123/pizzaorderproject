@extends('admin.layout.master')

@section('title','Pizza Detail')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-lg-10 offset-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <button onclick="history.back()"><i class="fa-solid fa-circle-left"></i> Back</button>
                                            <h3 class="text-center mb-3">Pizza Details</h3>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-5">
                                                <img src="{{ asset('storage/'.$product->image) }}" class="img-thumbnail shadow-sm" style="width:300px;height:200px;object-fit:cover"/>
                                            </div>
                                            <div class="col-7">
                                                <div class="row my-3">
                                                    <p class="col-1"><i class="fa-solid fa-pizza-slice"></i></p>
                                                    <p class="col-9">{{ $product->name }}</p>
                                                </div>
                                                <div class="row my-3">
                                                    <p class="col-1"><i class="fa-solid fa-cart-shopping"></i></p>
                                                    <p class="col-9">{{ $product->category_name }}</p>
                                                </div>
                                                <div class="row my-3">
                                                    <p class="col-1"><i class="fa-solid fa-hand-holding-dollar"></i></p>
                                                    <p class="col-9">{{ $product->price }}</p>
                                                </div>
                                                <div class="row my-3">
                                                    <p class="col-1"><i class="fa-solid fa-hourglass-start"></i></p>
                                                    <p class="col-9">{{ $product->waiting_time }} Minutes</p>
                                                </div>
                                                <div class="row my-3">
                                                    <p class="col-1"><i class="fa-regular fa-calendar-check"></i></p>
                                                    <p class="col-9">{{ $product->created_at->format('d F Y') }}</p>
                                                </div>
                                                <div class="row my-3">
                                                    <p class="col-1"><i class="fa-solid fa-circle-info"></i></p>
                                                    <p class="col-9">{{ $product->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-3 offset-9 mt-1">
                                            <a href="{{ route('product#editPage',$product->id) }}">
                                                <button class="btn btn-sm bg-dark text-white">
                                                    <i class="fa-solid fa-user-pen"></i> Edit Pizza
                                                </button>
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection
