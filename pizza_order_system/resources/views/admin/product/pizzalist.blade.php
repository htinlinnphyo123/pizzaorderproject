@extends('admin.layout.master')

@section('title','Pizza List Page')

@section('content')

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <!-- START DATA TABLE -->

                                {{-- Start Table Tools  --}}
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">Pizza List</h2>

                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="{{ route('product#createPage') }}">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                <i class="zmdi zmdi-plus"></i>Add Pizza
                                            </button>
                                        </a>
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            CSV download
                                        </button>
                                    </div>
                                </div>
                                {{-- End Table Tools  --}}

                                {{-- Start Search For Pizza --}}
                                <div class="row my-3">
                                    <div class="col-2">
                                        <span class="border border-info px-1 border-bottom-0 border-right-0 border-top-0">
                                            Total : {{ $products->total() }} <i class="fa-solid fa-database px-1"></i>
                                        </span>
                                    </div>
                                    <div class="col-4 offset-6">
                                        <form action="{{ route('product#list') }}" method="get">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="text" name="key" class="form-control form-control-sm " placeholder="Search Pizza ..." value="{{ request('key') }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- End Search For Pizza --}}

                                {{-- Start Create Pizza Alert --}}
                                @if (session('createPizzaSuccess'))
                                    <div class="col-6 offset-6">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-pizza-slice"></i>  {{ session('createPizzaSuccess') }}
                                            <br>
                                            <p class="text-muted">Successfully Create Your Pizza</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                {{-- End Create Pizza Alert --}}

                                {{-- Start Delete Success Alert  --}}

                                @if (session('deleteSuccess'))
                                    <div class="row">
                                        <div class="col-6 offset-6">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-trash"></i>  {{ session('deleteSuccess') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- End Delete Success Alert --}}

                                {{-- Start Update Success Alert --}}
                                @if (session('updatePizzaSuccess'))
                                    <div class="row">
                                        <div class="col-6 offset-6">
                                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-trash"></i>  {{ session('updatePizzaSuccess') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- End Update Success Alert --}}

                                {{-- Start Product List  --}}
                                @if(count($products)!=0)
                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2 text-center mb-3">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Pizza Name</th>
                                                    <th>Category name</th>
                                                    <th>Price</th>
                                                    <th>View Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $p)
                                                    <tr style="border-bottom:1px solid;">
                                                        <td class="col-2" style="cursor:pointer;"><img src="{{ asset('storage/'.$p->image) }}" alt=""></td>
                                                        <td>{{ $p->name }}</td>
                                                        <td>{{ $p->category_name }}</td>
                                                        <td>{{ $p->price }}</td>
                                                        <td><i class="fa-solid fa-eye" style="margin-right:6px;"></i>{{ $p->view_count }}</td>

                                                        <td>
                                                            <div class="table-data-feature" style="justify-content:end;">
                                                                <a href="{{ route('product#detail',$p->id) }}">
                                                                    <button class="item mx-1" data-toggle="tooltip" data-placement="top" title="Details">
                                                                        <i class="fa-solid fa-circle-info"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="{{ route('product#editPage',$p->id) }}">
                                                                    <button class="item mx-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="{{ route('product#delete',$p->id) }}">
                                                                    <button class="item mx-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <span class="">{{ $products->links() }}</span>

                                    </div>
                                @else
                                    <h2 class="text-center" style="margin-top:150px;letter-spacing:3px;">There  is  no  pizza  related  with  '{{ request('key') }}'</h2>
                                @endif

                                {{-- End Category List  --}}

                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection
