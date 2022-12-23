@extends('admin.layout.master')

@section('title','Order Details Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <!-- START DATA TABLE -->

                                {{-- Start Search For Pizza --}}
                                <div class="row my-3">
                                    <div class="col-4">
                                        <p onclick="history.back()" style="cursor:pointer;"><i class="fa-solid fa-arrow-left"></i><span class="px-2">Back to order list</span></p><br>
                                        <span class="border border-info px-1 border-bottom-0 border-right-0 border-top-0 d-block my-3">
                                            Order Code : {{ $users->order_code }}
                                        </span><br>
                                        <span class="border border-info px-1 border-bottom-0 border-right-0 border-top-0">
                                            Total : <span id="orderCount">{{ count($orders) }}</span> <i class="fa-solid fa-database px-1"></i>
                                        </span>
                                    </div>
                                    <div class="col-7 offset-1">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @if ($users->image!==null)
                                                            <img src="{{ asset('storage/'.$users->image) }}" class="img-thumbnail shadow-sm">
                                                        @else
                                                            <img src="{{ asset('admin/images/defaultuserimage.png') }}" class="img-thumbnail shadow-sm"/>
                                                        @endif
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="row my-3">
                                                            <h4 class="col-2"><i class="fa-solid fa-user mx-3"></i></h4>
                                                            <h4 class="col-9">{{ $users->name }}</h4>
                                                        </div>
                                                        <div class="row my-3">
                                                            <h4 class="col-2"><i class="fa-solid fa-envelope mx-3"></i></h4>
                                                            <h4 class="col-9">{{ $users->email }}</h4>
                                                        </div>
                                                        <div class="row my-3">
                                                            <h4 class="col-2"><i class="fa-solid fa-phone mx-3"></i></h4>
                                                            <h4 class="col-9">{{ $users->phone }}</h4>
                                                        </div>
                                                        <div class="row my-3">
                                                            <h4 class="col-2"><i class="fa-solid fa-location-dot mx-3"></i></h4>
                                                            <h4 class="col-9">{{ $users->address }}</h4>
                                                        </div>
                                                        <div class="row my-3">
                                                            <h4 class="col-2"><i class="fa-solid fa-receipt mx-3"></i></h4>
                                                            <h4 class="col-9">{{ $users->order_total_price }} Kyats ({{ $users->order_total_price-3000 }}+3000 Deli)</h4>
                                                        </div>
                                                        <div class="row my-3">
                                                            <h4 class="col-2"><i class="fa-solid fa-money-bill mx-3"></i></h4>
                                                            <h4 class="col-9">{{ $users->payment }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Search For Pizza --}}

                                {{-- Start Product List  --}}
                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2 text-center mb-3">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Rate/Count</th>
                                                    <th>Total</th>
                                                    <th>Ordered Time</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach ($orders as $o)
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img src="{{ asset('storage/'.$o->product_image) }}" class="img-thumbnail" style="width:90px" alt="">
                                                        </td>
                                                        <td class="align-middle">{{ $o->product_name }}</td>
                                                        <td class="align-middle">{{ $o->price }}/{{ $o->qty }}</td>
                                                        <td class="align-middle">{{ $o->product_total_price }}</td>
                                                        <td class="align-middle">{{ date('d-M-Y,H:i',strtotime($o->ordered_time)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>


                                {{-- End Category List  --}}

                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection
