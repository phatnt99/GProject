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
                    <h1>List User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                    <a type="button" href="{{route("user.create")}}" class="btn btn-outline-primary">Register new
                        user</a>
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
                            <form name="filter" action="{{route("user.search")}}" method="GET">
                                <h6 class="mb-3 text-bold">Account</h6>
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" name="login_id" placeholder="Login ID" value="{{old("login_id")}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{old("email")}}">
                                    </div>
                                </div>
                                <h6 class="mb-3 text-bold">Personal Information</h6>
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" name="first_name" placeholder="First name" value="{{old("first_name")}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="last_name" placeholder="Last name" value="{{old("last_name")}}">
                                    </div>
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
                                <h6 class="mb-3 text-bold">Company Information</h6>
                                <div class="row form-group">
                                    <div class="col">
                                        <select class="form-control" id="company_id" name="company_id">
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}" {{old('company_id') == $company->id ? "selected" : null}}>{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="code" placeholder="Code" value="{{old("code")}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="position" placeholder="Position" value="{{old("position")}}">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" id="start_at" name="start_at" type="text" onfocus="(this.type='date')" onblur="(this.type='text')"
                                               placeholder="Start At" value="{{old("start_at")}}"/>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" id="end_at" name="end_at" type="text" onfocus="(this.type='date')" onblur="(this.type='text')"
                                               placeholder="End At" value="{{old("end_at")}}"/>
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
                                @foreach($users as $user)
                                    <tr id="{{$user->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->login_id}}</td>
                                        <td><img width="70px" height="70px" src="{{$user->file ?url($user->file->path) : null}}"/></td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td><input type="checkbox" {{$user->gender == 0 ? "checked" : ""}} disabled>
                                        </td>
                                        <td>{{$user->birthday}}</td>
                                        <td>{{$user->address}}</td>
                                        <th>
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                More
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route("user.detail", $user)}}">Detail</a>
                                                <a class="dropdown-item" href="{{route("user.edit", $user)}}">Edit</a>
                                                <form method="POST" onSubmit="return confirmDelete();" action="{{route("user.delete", $user)}} ">
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
                    {{$users->links()}}
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
