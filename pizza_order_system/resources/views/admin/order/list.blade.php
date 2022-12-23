@extends('admin.layout.master')

@section('title','Order List Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <!-- START DATA TABLE -->

                                {{-- Start Search For Pizza --}}
                                <div class="row my-3">
                                    <div class="col-2">
                                        <span class="border border-info px-1 border-bottom-0 border-right-0 border-top-0">
                                            Total : <span id="orderCount">{{ count($orders) }}</span> <i class="fa-solid fa-database px-1"></i>
                                        </span>
                                    </div>

                                    <div class="col-3 offset-7">
                                        <form action="{{ route('admin#filterOrderStatus') }}" method="get">
                                            <div class="input-group mb-3">
                                                <select name="status" id="" class="form-control shadow-none">
                                                    <option value="all">All</option>
                                                    @if (isset($status))
                                                        <option value="pending" @if($status=='pending') selected @endif>Pending</option>
                                                        <option value="rejected" @if($status=='rejected') selected @endif>Rejected</option>
                                                        <option value="success" @if($status=='success') selected @endif>Success</option>
                                                    @else
                                                        <option value="pending">Pending</option>
                                                        <option value="rejected">Rejected</option>
                                                        <option value="success">Success</option>
                                                    @endif
                                                </select>
                                                <button type="submit" class="btn btn-secondary">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- End Search For Pizza --}}

                                {{-- Start Product List  --}}
                                @if(count($orders)!=0)
                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2 text-center mb-3">
                                            <thead>
                                                <tr>
                                                    <th>User id</th>
                                                    <th>Email</th>
                                                    <th>Order Code</th>
                                                    <th>Total</th>
                                                    <th>Ordered Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @foreach ($orders as $o)
                                                    <tr>
                                                        <td class="align-middle">{{ $o->user_id }}</td>
                                                        <td class="align-middle">{{ substr($o->email,0,6) }}*****</td>
                                                        <td id="odcode" class="align-middle"><a href="{{ route('admin#orderDetails',$o->order_code) }}">{{ $o->order_code }}</a></td>
                                                        <td class="align-middle">{{ $o->order_total_price }}</td>
                                                        <td class="align-middle">{{ date('d-M-Y,H:i',strtotime($o->order_created_at)) }}</td>
                                                        <td class="align-middle">
                                                            <select name="" id="statusList" class="form-control shadow-none border @if($o->status==0) border-warning @elseif($o->status==1) border-danger @else border-success @endif border-5">
                                                                <option value="0" @if($o->status==0) selected @endif>Pending</option>
                                                                <option value="1" @if($o->status==1) selected @endif>Reject</option>
                                                                <option value="2" @if($o->status==2) selected @endif>Success</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                @else
                                    <h2 class="text-center" style="margin-top:150px;letter-spacing:3px;">There is no order.</h2>
                                @endif

                                {{-- End Category List  --}}

                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection

@section('scriptSource')

    <script type="text/javascript">
        $(document).ready(function(){

            //to filter
            // $('#filterByStatus').change(function(){
            //     $status  = $('#filterByStatus').val();
            //     // console.log($status);


            //     $.ajax({
            //         type : 'get',
            //         url : '/order/ajaxList',
            //         data : {
            //             'status' : $status
            //         },
            //         dataType : 'json',
            //         success : function($response){
            //             // console.log(response.data);

            //             $lists = '';

            //             $response = $response;
            //             $reslen = $response.length;
            //             $('#orderCount').html($reslen);

            //             for(let i=0;i<$response.length;i++){
            //                 // console.log('hey');

            //                 //for email
            //                 function foremail(email){
            //                     return email.substring(0,6);
            //                 }

            //                 //for date
            //                 $formonth = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec']
            //                 $date = new Date($response[i].order_created_at);
            //                 // console.log($date);
            //                 $getMonth= $date.getMonth();
            //                 $getYear = $date.getFullYear();
            //                 $getHour = $date.getHours() < 10 ? '0'+$date.getHours() : $date.getHours();
            //                 $getMinutes= $date.getMinutes() < 10 ? '0'+$date.getMinutes() : $date.getMinutes();
            //                 $getDate = $date.getDate() < 10 ? '0'+$date.getDate() : $date.getDate();
            //                 $fordate = `${$getDate}-${$formonth[$getMonth]}-${$getYear},${$getHour}:${$getMinutes}`;

            //                 //for select option selected
            //                 function statusfunction(index){
            //                     if($response[i].status==index){
            //                         return 'selected';
            //                     }
            //                 }
            //                 $borderColor = '';
            //                 function borderStatusOrder(){
            //                     if($response[i].status==0){
            //                         $borderColor = 'border-warning';
            //                     }else if($response[i].status==1){
            //                         $borderColor = 'border-danger';
            //                     }else{
            //                         $borderColor = 'border-success';
            //                     }
            //                 }
            //                 borderStatusOrder();

            //                 $lists += `
            //                     <tr>
            //                         <td class="align-middle">${$response[i].user_id}</td>
            //                         <td class="align-middle">${foremail($response[i].email)}*****</td>
            //                         <td id="odcode" class="align-middle">${$response[i].order_code}</td>
            //                         <td class="align-middle">${$response[i].order_total_price}</td>
            //                         <td class="align-middle">${$fordate}</td>
            //                         <td class="align-middle">
            //                             <select id="statusList" class="form-control shadow-none border ${$borderColor} border-5">
            //                                 <option value="0" ${statusfunction(0)}>Pending</option>
            //                                 <option value="1" ${statusfunction(1)}>Reject</option>
            //                                 <option value="2" ${statusfunction(2)}>Success</option>
            //                             </select>
            //                         </td>
            //                     </tr>

            //                 `
            //             }

            //             $('#tbody').html($lists);

            //         }
            //     })

            //     console.log($('#tbody').html());

            // })

            //to change order status by admin
            $('tbody td').find('#statusList').change(function(){
                // console.log('hay')
                $orderStatus = $(this).val();
                $orderCode =  $(this).parents('tr').find('#odcode').text();
                // console.log($orderCode);

                $.ajax({
                    type : 'get',
                    url : '/order/statusChange',
                    data : {
                        'order_status' : $orderStatus,
                        'order_code' : $orderCode
                    },
                    dataType : 'json',
                    success : function(response){
                        console.log(response);
                        location.reload();
                    }

                })

            })

        })


    </script>

@endsection
