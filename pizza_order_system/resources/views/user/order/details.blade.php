@extends('user.layouts.master')

@section('title','Product Details')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <input type="hidden" name="userId" id="userId" value="{{ Auth::user()->id }}">
    <input type="hidden" name="productId" id="productId" value="{{ $selectProduct->id }}">
    <input type="hidden" name="userName" id="userName" value="{{ Auth::user()->name }}">
    <input type="hidden" id="productName" value="{{ $selectProduct->name }}">
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="bg-light">
                        <div class="carousel-item active" style="">
                            <img class="w-100 h-100 img-thumbnail" src="{{ asset('storage/'.$selectProduct->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $selectProduct->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-warning mr-2">
                            @foreach(range(1,5) as $i)
                                <span class="fa-stack" style="width:1em">
                                    <i class="far fa-star fa-stack-1x text-secondary"></i>

                                    @if($avgRating >0)
                                        @if($avgRating >0.5)
                                            <i class="fas fa-star fa-stack-1x"></i>
                                        @else
                                            <i class="fas fa-star-half fa-stack-1x"></i>
                                        @endif
                                    @endif
                                    @php $avgRating-- @endphp
                                </span>
                            @endforeach
                        </div>
                        <small class="pt-1">({{ $selectProduct->view_count }} @if($selectProduct->view_count<2) view @else views @endif)</small>
                    </div>
                    <p class="mb-3"><i class="fa-duotone fa-dollar-sign me-2"></i>{{ $selectProduct->price }}</p>
                    <p class="mb-3"><i class="fa-solid fa-clock me-2 fa-sm"></i>{{ $selectProduct->waiting_time }} Minutes</p>
                    <p class="mb-3">{{ $selectProduct->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-outline-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="totalitem" class="form-control border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-outline-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button id="alertcartadd" type="button" data-bs-toggle="modal" data-bs-target="#addtocartmodal" class="btn btn-outline-warning px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2"> {{ $Rating->count_rater }} @if($Rating->count_rater<2) Review @else Reviews @endif</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Write a review</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Details Reviews</h4>
                            <div class="mb-4">
                                <div class="row">
                                    @if(count($reviews)!==0)
                                        @foreach ($reviews as $r)
                                            <div class="col-12 mb-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-1 text-center">
                                                                @if($r->user_image == null)
                                                                    @if($r->gender=='male')
                                                                        <img src="{{ asset('admin/images/defaultuserimage.png') }}" class="rounded-circle shadow-sm" style="width:45px"/>
                                                                    @else
                                                                        <img src="{{ asset('admin/images/defaultuserimagefemale.jpg') }}" class="rounded-circle shadow-sm" style="width:45px"/>
                                                                    @endif
                                                                @else
                                                                    <img src="{{ asset('storage/'.$r->user_image) }}" class="img-fluid rounded-circle shadow-sm" style="width:45px">
                                                                @endif
                                                            </div>
                                                            <div class="col-11">
                                                                <div class="row">
                                                                    <div class="col-9"><h6>{{ $r->user_name }}</h6>
                                                                        <div class="text-warning">
                                                                            @for ($i = 0;$i<$r->rating_count;$i++)
                                                                                <i class="fas fa-star fa-sm"></i>
                                                                            @endfor
                                                                            @for ($i = 0;$i<5-$r->rating_count;$i++)
                                                                                <i class="far fa-star fa-sm"></i>
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <span>{{ $r->created_at->format('d-F-Y H:i:s') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <span>
                                                            @if (strlen($r->message) > 200)
                                                                {{ Str::substr($r->message,0,200) }} <a href="#" class="text-decoration-none"> ....... Read More</a>
                                                            @else
                                                                {{ $r->message }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <h3 class="text-warning mt-5 mx-5 text-center">There is no review for {{ $selectProduct->name }}</h3>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">{{ $Rating->count_rater }} @if($Rating->count_rater<2) Review @else Reviews @endif for "{{ $selectProduct->name }}"</h4>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mt-5">
                                                <div class="d-flex justify-content-center">
                                                    <div class="text-warning text-center">
                                                        <h4 class="text-warning text-center">{{ $avgRatingTwo }} / 5</h4>

                                                        @foreach(range(1,5) as $i)
                                                            <span class="fa-stack text-center my-4" style="width:1em">
                                                                <i class="far fa-star fa-stack-1x text-secondary"></i>
                                                                @if($avgRatingTwo >0)
                                                                    @if($avgRatingTwo >0.5)
                                                                        <i class="fas fa-star fa-stack-1x"></i>
                                                                    @else
                                                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                                                    @endif
                                                                @endif
                                                                @php $avgRatingTwo-- @endphp
                                                            </span>
                                                        @endforeach

                                                        <h4 class="text-warning text-center">{{ $selectProduct->view_count }} Views</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            @foreach ($eachRating as $each)
                                                <div class="row align-items-center">
                                                    <div class="col-2 text-secondary">
                                                        <span>{{ ceil($each->rating_avg) }}<i class="fa-solid fa-star text-warning"></i></span>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="progress my-3">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Example with label" style="width: {{ $each->count_rater / $Rating->count_rater*100 }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ floor($each->count_rater / $Rating->count_rater*100) }}%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <form action="{{ route('user#rating') }}" method="post">
                                        @csrf
                                        <input type="hidden" id="productId" name="productId" value="{{ $selectProduct->id }}">
                                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="rating_count" id="ratingCount" value="1">
                                            <div class="rating">
                                                <input type="radio" name="star" id="star1" class="star"><label for="star1"><span class="getrating"><i class="fa-solid fa-star"></i></span></label>
                                                <input type="radio" name="star" id="star2" class="star"><label for="star2"><span class="getrating"><i class="fa-solid fa-star"></i></span></label>
                                                <input type="radio" name="star" id="star3" class="star"><label for="star3"><span class="getrating"><i class="fa-solid fa-star"></i></span></label>
                                                <input type="radio" name="star" id="star4" class="star"><label for="star4"><span class="getrating"><i class="fa-solid fa-star"></i></span></label>
                                                <input type="radio" name="star" id="star5" class="star" checked><label for="star5"><span class="getrating"><i class="fa-solid fa-star"></i></span></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Your Review *</label>
                                                <textarea name="review" id="message" cols="30" rows="5" class="form-control @error('review') is-invalid @enderror"></textarea>
                                                @error('review')
                                                <div class="invalid-fedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-0 d-grid">
                                                <input type="submit" value="Leave Your Review" class="btn btn-outline-warning px-3">
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    @if (session('success'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="position-relative text-uppercase mx-xl-5 mb-4"><span class="">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($restProduct as $rp)
                        <div class="product-item bg-light mb-5 rounded-3" style="height:300px;">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$rp->image) }}" style="height:150px;object-fit:cover;" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails',$rp->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $rp->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5><i class="fa-duotone fa-dollar-sign me-2"></i> {{ $rp->price }}</h5>
                                </div>
                                <div class="text-center text-muted">
                                    <small>Waiting time - {{ $rp->waiting_time }} Minutes</small><br>
                                    <small>{{ $rp->view_count }} <i class="fa-solid fa-eye"></i></small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    {{-- Start Modal  --}}

    {{-- start confirmatin model  --}}
    <div id="addtocartmodal" class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirm Add to cart ?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="carttext">Some text</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="addtocartbtn" class="btn btn-outline-warning">Ok</button>
            </div>
          </div>
        </div>
      </div>
      {{-- end confirmation modal --}}

    {{-- End Modal --}}


@endsection


@section('script')

    <script type="text/javascript">
        $(document).ready(function(){

            var $input = $('.rating input[type="radio"]');
            $input.change(function(){

                $filter = $('.getrating').filter(function() {
                    return $(this).css('display') == 'block';
                });

                $('#ratingCount').val($filter.length);


            })

            //for view count increase
            $productId = $('#productId').val();
            $.ajax({
                type : 'get',
                url : 'increase/viewCount',
                dataType : 'json',
                data : {
                    'productId' : $productId
                }
            })

            $('#alertcartadd').click(function(){
                $count = $('#totalitem').val();
                $userName = $('#userName').val();
                $productName = $('#productName').val();

                console.log($count,$userName,$productName);

                $('#carttext').html(`Dear ${$userName}, <br>
                        Are you sure to add ${$count} for ${$productName} to cart ?
                `);

            })


            $('#addtocartbtn').click(function(){
                // $totalitem = $('#totalitem').val();

                $data = {
                    'count' : $('#totalitem').val(),
                    'userId' : $('#userId').val(),
                    'productId' : $('#productId').val()
                }

                // console.log($data);

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/cart',
                    data : $data,
                    dataType : 'json',
                    success : function(response){
                        // console.log(response);

                        if(response.status == 'success'){
                            window.location.href = 'http://127.0.0.1:8000/user/homePage';
                            // alert('added to cart successfully');
                        }

                    }


                })


            })
        })
    </script>


@endsection




