@extends('user.layouts.master')

@section('title','Cart List Page')

@section('content')

 <!-- Breadcrumb Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            @if (count($carts))
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="itemrow">
                        @foreach ($carts as $c)
                        <tr>
                            <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" id="productId" value="{{ $c->product_id }}">
                            <input type="hidden" id="cartId" value="{{ $c->cart_id }}">
                            <td class=""><img class="img-thumbnail" src="{{ asset('storage/'.$c->image) }}" alt="" style="width: 100px;height:80px;object-fit:cover;"></td>
                            <td class="align-middle">{{ $c->product_name }}</td>
                            <td id="productprice" class="align-middle">{{ $c->product_price }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        @if ($c->qty==1)
                                            <button id="btn-minus" class="btn btn-sm btn-warning btn-minus" disabled>
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        @else
                                            <button id="btn-minus" class="btn btn-sm btn-warning btn-minus" >
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        @endif
                                    </div>
                                    <input type="text" id="productqty" class="form-control form-control-sm border-0 text-center" value="{{ $c->qty }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td id="itemtotal" class="align-middle">{{ ($c->qty)*($c->product_price) }} Kyats</td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-danger btnremove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="mt-4 py-3 px-2 text-warning text-center">There is no item in your cart list.</h3>
            @endif
        </div>
        <div class="col-lg-4">
            <h5 class="text-uppercase mb-3"><span>Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subtotalprice">{{ $totalprice }} Kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">3000 Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="billtotal">
                            @if ($totalprice==0)
                                0 Kyat
                            @else
                                {{ $totalprice+3000 }} Kyats
                            @endif
                        </h5>
                    </div>
                    <div class="d-flex justify-content-between my-2">
                        <h6>Payment Method</h6>
                        <select name="form-select form-select-sm" id="payment" class="px-1" style="border-radius:5px;">
                            <option value="Cash">Cash</option>
                            <option value="Banking">Banking</option>
                        </select>
                    </div>
                    <button id="submitBtn" class="btn btn-block btn-warning font-weight-bold my-3 py-3" @if($totalprice==0) disabled @endif>Proceed To Checkout</button>
                    <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3" @if($totalprice==0) disabled @endif>Clear Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

@section('script')

    <script type="text/javascript">

        //for ui change and total bill price change
        $(document).ready(function(){

            //plus minus function
            $('.btn').click(function(){
                //for each item
                $productPrice = Number($(this).parents('tr').find('#productprice').html());
                $qty = $(this).parents('tr').find('#productqty').val();

                $totalprice = $productPrice*$qty;
                $kyats = ' Kyats';
                // console.log($totalprice);
                $(this).parents('tr').find('#itemtotal').html($totalprice + $kyats);

                // for summary payment
                summaryCalculation();

                console.log($(this).parents('tr').find('#productqty').val());


                if($qty==1){
                    $(this).parents('tr').find('#btn-minus').prop('disabled',true);
                }else{
                    $(this).parents('tr').find('#btn-minus').prop('disabled',false);
                }

            })

            //to remove each cart list
            $('.btnremove').click(function(){
                $(this).parents('tr').remove();
                summaryCalculation();
                $cartId = $(this).parents('tr').find('#cartId').val();
                $totalp = $('#subtotalprice').text();
                if($totalp=='0 Kyats'){
                    $('#subtotalprice').text('0 Kyat');
                    $('#billtotal').text('0 Kyat');
                    $('#submitBtn').prop('disabled',true);
                    $('#clearBtn').prop('disabled',true);
                }


                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/eachCartDelete',
                    data : {
                        'cart_id' : $cartId
                    },
                    dataType : 'json'

                })

            })

            //function for summary payment
            function summaryCalculation(){
                $(this).parents('tr').remove();
                $totalbillprice=0;
                $('#itemrow tr').each(function(index,row){
                    $totalbillprice += Number($(row).find('#itemtotal').text().replace('Kyats',''));
                    // console.log($totalbillprice);
                })

                $('#subtotalprice').html($totalbillprice + " Kyats");
                $('#billtotal').html($totalbillprice+3000 + " Kyats");
            }

            //for ajax request for order
            $('#submitBtn').click(function(){
                $eachPrice = 0;

                $orderPrice = [];

                $forordercode = Math.round(Math.random()*100001);
                $forordercodedateone = new Date('2002,8,3');
                $forordercodedatetwo = new Date();
                $datedifference = ($forordercodedatetwo - $forordercodedateone).toString().substr(4,5);
                // console.log($forordercode);
                // console.log($datedifference);

                $('#itemrow tr').each(function(index,row){
                    $eachproductPrice = Number($(row).find('#itemtotal').text().replace('Kyats',''));
                    // console.log($eachproductPrice);
                    $orderPrice.push({
                        'user_id' : $(row).find('#userId').val(),
                        'product_id' : $(row).find('#productId').val(),
                        'qty' : $(row).find('#productqty').val(),
                        'product_total_price' : $eachproductPrice,
                        'order_code' : $forordercode+'000'+$datedifference,
                        'payment' : $('#payment').val()
                    });
                })

                // console.log($orderPrice);
                $orderPrice = Object.assign({},$orderPrice);
                // console.log($orderPrice);

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/order',
                    data : $orderPrice,
                    dataType : 'json',
                    success : function(response){
                        if(response.status=='success'){
                            // console.log(response);
                            window.location.href = 'http://127.0.0.1:8000/user/homePage';
                        }
                    }
                })
            })

            //clear cart btn
            $('#clearBtn').click(function(){

                $('#itemrow tr').remove();
                $('#subtotalprice').text('0 Kyat');
                $('#billtotal').text('0 Kyat');


                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/cartDelete',
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                            $('#submitBtn').prop('disabled',true);
                            $('#clearBtn').prop('disabled',true);
                        }
                    }
                })

            })


        })

    </script>


@endsection
