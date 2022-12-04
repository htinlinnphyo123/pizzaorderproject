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
                                            Total :  <i class="fa-solid fa-database px-1"></i>
                                        </span>
                                    </div>
                                    <div class="col-7 offset-3">
                                        <form action="{{ route('category#list') }}" method="get">
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
                                        <table class="table table-data2">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
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
