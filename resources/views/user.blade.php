@extends("layouts.root")

@section("css")
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        .clicked {
            background-color: #dee2e6
        }
    </style>
@endsection

@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
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
                <div class="col-2">
                    <a type="button" href="{{route("user.create")}}" class="btn btn-outline-primary">Register new
                        user</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
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
                                <td><img width="70px" height="70px" src="{{url($user->file->path)}}"/></td>
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
                                        <form method="POST" action="{{route("user.delete", $user)}}">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="dropdown-item">Delete</button>
                                        </form>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
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
    //clicked row event
    <script>
        $(document).ready(function () {

            $("[name='detail']").click(function () {
                //get selected id from tr
                var selectedUser = $('tr.clicked').attr('id');

                location.href = "{{url('users')}}" + "/" + selectedUser;
            });

            $("[name='delete']").click(function () {
                //get selected id from tr
                var selectedUser = $('tr.clicked').attr('id');

                //ajax request
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url('users')}}" + "/" + selectedUser,
                    type: "DELETE",
                    success: function (data) {
                        location.href = "{{route("user")}}";
                    }
                });
            });

        })
    </script>
@endsection
