@extends('admin.layout.master')

@section('title','User List Page')

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
                                            Total : {{ $users->total() }} <i class="fa-solid fa-database px-1"></i>
                                        </span>
                                    </div>
                                    <div class="col-4 offset-6">
                                        <form action="{{ route('admin#userListPage') }}" method="get">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="text" name="key" class="form-control form-control-sm " placeholder="Search users ..." value="{{ request('key') }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- End Search Category List --}}

                                {{-- Start Category List  --}}
                                @if (count($users)!=0)
                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Created date</th>
                                                    <th style="text-align:center">Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                <tr class="tr-shadow" style="margin-bottom:3px;">
                                                        <td id="userId">{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->created_at->format('d-F-Y') }}</td>
                                                        <td>
                                                            <select name="" id="accountStatus" class="form-control">
                                                                <option value="admin">Admin</option>
                                                                <option value="user" selected>User</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <a href="{{ route('admin#userAccountDelete',$user->id) }}">
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
                                            {{ $users->links() }}
                                        </div>

                                    </div>
                                    @else
                                    <h3 class="text-secondary text-center mt-5">There is no user here.</h3>
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
            $('tbody #accountStatus').change(function(){

                $accStatus = $(this).val();
                $userId = $(this).parents('tr').find('#userId').text();
                // console.log($userId);
                // console.log($accStatus);

                $.ajax({
                    type : 'get',
                    url : '/user/statusChange',
                    dateType : 'json',
                    data : {
                        'status' : $accStatus,
                        'userId' : $userId
                    },
                    success : function(response){
                        console.log(response);
                        if(response.status == 'successful'){
                            location.reload();
                        }
                    }

                })

            })


        })
    </script>

@endsection
