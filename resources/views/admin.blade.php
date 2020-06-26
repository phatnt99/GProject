@extends("layouts.root")

@section("css")
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row" style="margin-bottom: 1rem">
                <div class="col-6">
                    <a type="button" href="{{route("admin.create")}}" class="btn btn-outline-primary">Register new
                        admin</a>
                </div>
                <div class="col-6">
                    <button class="btn btn-danger float-right" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body collapse" id="collapseExample">
                            <form name="filter" action="{{route("admin.search")}}" method="GET">
                                <h6 class="mb-3">Account</h6>
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" name="login_id" placeholder="Login ID" value="{{old("login_id")}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{old("email")}}">
                                    </div>
                                </div>
                                <h6 class="mb-3">Personal Information</h6>
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" name="first_name" placeholder="First name" value="{{old("first_name")}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="last_name" placeholder="Last name" value="{{old("last_name")}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        <input class="form-control" id="birthday" name="birthday" type="text" onfocus="(this.type='date')" onblur="(this.type='text')"
                                               placeholder="Birthday" value="{{old("birthday")}}"/>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="address" placeholder="Address" value="{{old("address")}}">
                                    </div>
                                    <div class="col">
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="0" {{old("gender") == 0 ? "selected": null}}>All</option>
                                            <option value="1" {{old("gender") == 1 ? "selected": null}}>Male</option>
                                            <option value="2" {{old("gender") == 2 ? "selected": null}}>Female</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary float-right">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="sorting">STT</th>
                                    <th class="sorting">Login ID</th>
                                    <th class="sorting">Avatar</th>
                                    <th class="sorting">First Name</th>
                                    <th class="sorting">Last Name</th>
                                    <th class="sorting">Email</th>
                                    <th class="sorting">Male</th>
                                    <th class="sorting">Birthday</th>
                                    <th class="sorting">Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $admin)
                                    <tr id="{{$admin->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$admin->login_id}}</td>
                                        <td><img width="70px" height="70px" src="{{$admin->file ?url($admin->file->path) : null}}"/></td>
                                        <td>{{$admin->first_name}}</td>
                                        <td>{{$admin->last_name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td><input type="checkbox" {{$admin->gender == 0 ? "checked" : ""}} disabled>
                                        </td>
                                        <td>{{$admin->birthday}}</td>
                                        <td>{{$admin->address}}</td>
                                        <th>
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                More
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route("admin.edit", $admin)}}">Edit</a>
                                                <form method="POST" onSubmit="return confirmDelete();" action="{{route("admin.delete", $admin)}} ">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                    <script>
                                                        function confirmDelete() {
                                                            return confirm("Xác nhận xóa?");
                                                        };
                                                    </script>
                                                </form>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{$admins->appends(request()->input())->links()}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section("script")
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="js/gproject_user.js"></script>
@endsection
