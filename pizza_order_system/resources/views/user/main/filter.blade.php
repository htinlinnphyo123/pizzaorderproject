@extends('user.layouts.master')

@section('title','Code Lab')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

<!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="text-uppercase mb-3">Filter by Category</h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-around mb-2 rounded-3 bg-warning">
                            <a class="py-2 m-0 text-dark text-decoration-none" href="{{ route('user#home') }}">Total Categories - {{ count($categories) }}</a>
                        </div>
                        <div class="row">
                            <div class="col-9 ps-5">
                                <b>Type</b>
                            </div>
                            <div class="col-3">
                                <b>Total</b>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-10">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        @foreach ($categories as $c)
                                            <div class="mb-3">
                                                <a href="{{ route('user#pizzaFilter',$c->id) }}" class="text-decoration-none text-dark"><i class="fa-solid fa-pizza-slice pr-2"></i>{{ $c->name }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-12">
                                        @foreach ($productCount as $p)
                                            <div class="mb-3">
                                                <span>{{ $p->total_category_id }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="" id="category_id" value="{{ $category_id->id }}">
                    </form>
                </div>
                <!-- Price End -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                                <a href="{{ route('user#cartListPage',Auth::user()->id) }}" class="ms-2">
                                    <button type="button" class="btn btn-sm btn-light position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                          {{ count($carts) }}
                                        </span>
                                      </button>
                                </a>
                            </div>
                            <div class="">
                                @if (session('pwchangeSuccess'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong><i class="fa-solid fa-lock me-1"></i> {{ session('pwchangeSuccess') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-select">
                                        <option value="">Sort by date <i class="fa-solid fa-down"></i></option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Desending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="detail.html">
                    <div id="listcontainer" class="row">
                        @foreach ($products as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4 shadow">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height:200px;object-fit:cover;" src="{{ asset('storage/'.$p->image) }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $p->price }} kyats</h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-warning mr-1"></small>
                                            <small class="fa fa-star text-warning mr-1"></small>
                                            <small class="fa fa-star text-warning mr-1"></small>
                                            <small class="fa fa-star text-warning mr-1"></small>
                                            <small class="fa fa-star text-warning mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
<!-- Shop End -->
@endsection


@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $('#sortingOption').change(function(){
                $eventOption = $('#sortingOption').val();
                $cateId = $('#category_id').val();
                console.log($cateId);

                // console.log($eventOption);
                if($eventOption=='asc'){
                    console.log('hey i am asc');
                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizza/list',
                        data : {
                            'status' : 'asc',
                            'category_id' : $cateId
                        },
                        dataType : 'json',
                        success : function(response){
                            // console.log(response);

                            $list = ``;

                            for(let $i=0;$i<response.length;$i++){
                                $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4 shadow">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" style="height:200px;object-fit:cover;" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href="http://127.0.0.1:8000/user/pizza/details/${response[$i].id}"><i class="fa-solid fa-circle-info"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${response[$i].price} kyats</h5>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mb-1">
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `
                            }

                            console.log($list);

                            $('#listcontainer').html($list);

                        }
                    })
                }else if($eventOption=='desc'){
                    console.log('hey i am desc');

                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizza/list',
                        data : {
                            'status' : 'desc',
                            'category_id' : $cateId
                        },
                        dataType : 'json',
                        success : function(response){
                            // console.log(response);

                            $list = ``;

                            for(let $i=0;$i<response.length;$i++){
                                $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4 shadow">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" style="height:200px;object-fit:cover;" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href="http://127.0.0.1:8000/user/pizza/details/${response[$i].id}"><i class="fa-solid fa-circle-info"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${response[$i].price} kyats</h5>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mb-1">
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `
                            }

                            console.log($list);

                            $('#listcontainer').html($list);

                        }
                    })

                }

            })
        })

    </script>

@endsection

