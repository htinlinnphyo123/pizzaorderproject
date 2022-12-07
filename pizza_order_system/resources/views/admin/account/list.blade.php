@extends('admin.layout.master')

@section('title','Admin List Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <!-- START DATA TABLE -->

                                {{-- Start Search Category List --}}
                                <div class="row my-3">
                                    <div class="col-2">
                                        <span class="border border-info px-1 border-bottom-0 border-right-0 border-top-0">
                                            Total :  {{ count($admins) }} <i class="fa-solid fa-database px-1"></i>
                                        </span>
                                    </div>
                                    <div class="col-7 offset-3">
                                        <form action="{{ route('admin#list') }}" method="get">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="text" name="key" class="form-control" placeholder="Search by name,email or address ..." value="{{ request('key') }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- End Search Category List --}}


                                {{-- Start Category List  --}}

                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2 text-center mb-3">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($admins as $a)
                                                    <tr>
                                                        <td>
                                                            @if ($a->image == null)
                                                                @if ($a->gender == 'male')
                                                                    <img src="{{ asset('admin/images/defaultuserimage.png') }}" alt="" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;">
                                                                @else
                                                                    <img src="{{ asset('admin/images/defaultuserimagefemale.jpg') }}" alt="" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;">
                                                                @endif
                                                            @else
                                                                <img src="{{ asset('storage/'.$a->image) }}" alt="" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $a->name }}</td>
                                                        <td>{{ $a->gender }}</td>
                                                        <td>{{ $a->phone }}</td>
                                                        <td>{{ $a->address }}</td>
                                                        <td>
                                                            @if($a->name!==Auth::user()->name)
                                                                <div class="table-data-feature text-right" style="justify-content:end;">
                                                                    <a href="{{ route('admin#roleChangePage',$a->id) }}">
                                                                        <button class="item mx-1" data-toggle="tooltip" data-placement="top" title="Role Change">
                                                                            <i class="fa-solid fa-user-pen"></i>
                                                                        </button>
                                                                    </a>
                                                                    <a href="{{ route('admin#delete',$a->id) }}">
                                                                        <button class="item mx-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-2">
                                            {{ $admins->links() }}
                                        </div>
                                    </div>

                                {{-- End Category List  --}}

                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection
