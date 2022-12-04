@extends('admin.layout.master')

@section('title','Category List Page')

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
                                            <h2 class="title-1">Category List</h2>

                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="{{ route('category#createPage') }}">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                <i class="zmdi zmdi-plus"></i>Add Category
                                            </button>
                                        </a>
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            CSV download
                                        </button>
                                    </div>
                                </div>
                                {{-- End Table Tools  --}}

                                {{-- Start Search Category List --}}
                                <div class="row my-3">
                                    <div class="col-2">
                                        <span class="border border-info px-1 border-bottom-0 border-right-0 border-top-0">
                                            Total : {{ $categories->total() }} <i class="fa-solid fa-database px-1"></i>
                                        </span>
                                    </div>
                                    <div class="col-4 offset-6">
                                        <form action="{{ route('category#list') }}" method="get">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="text" name="key" class="form-control form-control-sm " placeholder="Search Categories ..." value="{{ request('key') }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- End Search Category List --}}

                                {{-- Start Create Success Alert   --}}
                                @if (session('createSuccess'))

                                    <div class="col-5 offset-7">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-check"></i>  {{ session('createSuccess') }}
                                            <br>
                                            <p class="text-muted">Your New Category is {{ session('getcatename') }}</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>

                                @endif
                                {{-- End Create Success Alert   --}}

                                {{-- Start Delete Success Alert --}}
                                @if (session('deleteSuccess'))
                                    <div class="col-7 offset-5">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-trash"></i>  {{ session('deleteSuccess') }}
                                            <br>
                                            <p class="text-muted">Successfully Deleted Your Category : {{ session('getdeleteCategory') }}</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                {{-- End Delete Success Alert --}}

                                {{-- Start Update Success Alert  --}}
                                @if(session('updateSuccess'))
                                    <div class="col-7 offset-5">
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-trash"></i>  {{ session('updateSuccess') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                {{-- End Update Success Alert  --}}

                                {{-- Start Password Change Success Alert --}}
                                @if(session('pwchange'))
                                <div class="col-7 offset-5">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-lock"></i>  {{ session('pwchange') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                {{-- End Password Change Success Alert --}}

                                {{-- Start Category List  --}}
                                @if (count($categories)!=0)
                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>category name</th>
                                                    <th>Created date</th>
                                                    <th style="text-align:center">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                <tr class="tr-shadow" style="margin-bottom:3px;">
                                                        <td>{{ $category->id }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->created_at->format('d-F-Y') }}</td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <a href="{{ route('category#edit',$category->id) }}">
                                                                    <button class="item mx-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        <i class="zmdi zmdi-edit"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="{{ route('category#delete',$category->id) }}">
                                                                    <button class="item mx-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <i class="zmdi zmdi-delete"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="mt-3">
                                            {{ $categories->links() }}
                                        </div>

                                    </div>
                                    @else
                                    <h3 class="text-secondary text-center mt-5">There is no category here.</h3>
                                @endif
                                {{-- End Category List  --}}

                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->

@endsection
