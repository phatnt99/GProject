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
                    <h1>List Device</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Loan Device</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            @if(Session::has('success'))
                <div class="col-6">
                    <div class="alert alert-success" role="alert">
                        <span>Borrow device <b>#{{Session::get('success')}}</b> successfully!</span>
                    </div>
                </div>
            @endif
            <div class="row" style="margin-bottom: 1rem">
                <div class="col-6"></div>
                <div class="col-6">
                    <button class="btn btn-danger float-right" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body collapse" id="collapseExample">
                            <form name="filter" action="{{route("user-dashboard.loan-device")}}" method="GET">
                                <h6 class="mb-3 text-bold">Device Information</h6>
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" name="code" placeholder="Code"
                                               value="{{old("code")}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="name" placeholder="Name"
                                               value="{{old("name")}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col">
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
                                    <th class="sorting">Name</th>
                                    <th class="sorting">Code</th>
                                    <th class="sorting">Price</th>
                                    <th class="sorting">Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($devices as $device)
                                    <tr id="{{$device->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$device->name}}</td>
                                        <td>{{$device->code}}</td>
                                        <td>{{$device->price}}</td>
                                        <td><img width="70px" height="70px"
                                                 src="{{$device->file ?url($device->file->path) : null}}"/></td>
                                        <td>
                                            <form method="POST"
                                                  action="{{route("user-dashboard.loan-device.create")}}">
                                                @csrf
                                                @method("POST")
                                                <input type="hidden" name="device_id" value="{{$device->id}}">
                                                <button type="submit" class="btn btn-info">Borrow</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{$devices->appends(request()->input())->links()}}
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
