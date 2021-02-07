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
                    <h1>Loan Device History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Loan Device History</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
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
                            <form name="filter" action="{{route("user-dashboard.loan-device.history")}}" method="GET">
                                <h6 class="mb-3 text-bold">Device Information</h6>
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" name="device_code" placeholder="Code"
                                               value="{{old("device_code")}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="device_name" placeholder="Name"
                                               value="{{old("device_name")}}">
                                    </div>
                                </div>
                                <h6 class="mb-3 text-bold">Status</h6>
                                <div class="form-group">
                                    <select class="form-control" id="status" name="status">
                                        <option value="" {{old("status") == null ? "selected": null}}>All
                                        </option>
                                        <option value="1" {{old('status') == '1' ? "selected" : null}}>Using</option>
                                        <option value="0" {{old('status') == '0' ? "selected" : null}}>Returned</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Search</button>
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
                                    <th class="sorting">Loan date</th>
                                    <th class="sorting">Return date</th>
                                    <th class="sorting">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userDevices as $userDevice)
                                    <tr id="{{$userDevice->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$userDevice->device->name}}</td>
                                        <td>{{$userDevice->device->code}}</td>
                                        <td>{{$userDevice->device->price}}</td>
                                        <td><img width="70px" height="70px"
                                                 src="{{$userDevice->device->image_link ?url($userDevice->device->image_link) : null}}"/></td>
                                        <td>{{$userDevice->loan_date}}</td>
                                        <td>{{$userDevice->return_date}}</td>
                                        <td>
                                            @if($userDevice->is_using)
                                                <div class="alert alert-info text-center" role="alert">Using</div>
                                            @else
                                                <div class="alert alert-dark text-center" role="alert">Returned</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{$userDevices->appends(request()->input())->links()}}
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
