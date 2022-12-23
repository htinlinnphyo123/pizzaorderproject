@extends('user.layouts.master')

@section('title','History List Page')

@section('content')

<!-- Cart Start -->
<div class="container-fluid" style="height:400px;">
    <div class="row px-xl-5">
        <div class="col-lg-10 offset-1 table-responsive mb-5">
            @if (count($orders)==0)
                <h3 class="text-warning text-center bold">There is no order history</h3>
            @else
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order Time</th>
                            <th>OrderCode</th>
                            <th>Total</th>
                            {{-- <th>Waiting Time</th> --}}
                            <th>Payment</th>
                            <th>Received Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="itemrow">
                        @foreach ($orders as $o)
                            <tr>
                                <td class="align-middle">{{ $o->created_at->format('h:i:s') }}</td>
                                <td class="align-middle">{{ $o->order_code }}</td>
                                <td class="align-middle">{{ $o->order_total_price }}</td>
                                {{-- <td>
                                    @foreach ($forwaitingtime as $fwtime)
                                        @if ($fwtime->wtordercode == $o->order_code)
                                            <span>{{ $fwtime->max_waiting_time }} Minutes</span>
                                        @endif
                                    @endforeach
                                </td> --}}
                                <td>{{ $o->payment }}</td>
                                <td>
                                    @foreach ($forwaitingtime as $fwtime)
                                        @if ($fwtime->wtordercode == $o->order_code)
                                            <span>{{ $o->created_at->addMinutes($fwtime->max_waiting_time)->format('h:i:s') }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <button class="btn btn-sm btn-warning">Pending</button>
                                    @elseif ($o->status == 1)
                                        <button class="btn btn-sm btn-danger">Rejected</button>
                                    @elseif ($o->status == 2)
                                        <button class="btn btn-sm btn-success">Accept</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="mt-2">{{ $orders->links() }}</p>
            @endif

        </div>

    </div>
</div>
<!-- Cart End -->

@endsection
