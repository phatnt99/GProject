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
                    <h1>Loan Device</h1>
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
            <div class="row" style="margin-bottom: 1rem">
                <div class="col-6">
                    <a type="button" href="{{route("loan-device.create")}}" class="btn btn-outline-primary">Add new
                        loan</a>
                </div>
                <div class="col-6">
                    <button class="btn btn-danger float-right" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter
                    </button>
                    <a href="{{route('loan-device.export')}}" class="btn btn-success">Export</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body collapse" id="collapseExample">
                            <form name="filter" action="{{route("loan-device.search")}}" method="GET">
                                <h6 class="mb-3 text-bold">User Information</h6>
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" name="user_code" placeholder="Code"
                                               value="{{old("user_code")}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="user_name" placeholder="Name"
                                               value="{{old("user_name")}}">
                                    </div>
                                </div>
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
                                <h6 class="mb-3 text-bold">Company Information</h6>
                                <div class="form-group">
                                    <select class="form-control" id="company_id" name="company_id">
                                        <option value="" {{old("company_id") == null ? "selected": null}}>All
                                        </option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}" {{old('company_id') == $company->id ? "selected" : null}}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
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
                                    <th class="sorting">User</th>
                                    <th class="sorting">Device</th>
                                    <th class="sorting">Company</th>
                                    <th class="sorting">Status</th>
                                    <th class="sorting">Loan date</th>
                                    <th class="sorting">Return date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loanDevices as $loanDevice)
                                    <tr id="{{$loanDevice->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$loanDevice->user->name}}</td>
                                        <td>{{$loanDevice->device->name}}</td>
                                        <td>{{$loanDevice->user->company->name}}</td>
                                        <td>
                                            @if($loanDevice->is_using)
                                                <div class="alert alert-info text-center" role="alert">Using</div>
                                            @else
                                                <div class="alert alert-dark text-center" role="alert">Returned</div>
                                            @endif
                                        </td>
                                        <td>{{$loanDevice->loan_date}}</td>
                                        <td>{{$loanDevice->return_date}}</td>
                                        <td>
                                            <div class="row">
                                                <form method="POST" onSubmit="return confirmDelete();"
                                                      action="{{route("loan-device.delete", $loanDevice)}}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    <script>
                                                      function confirmDelete () {
                                                        return confirm('Xác nhận xóa?')
                                                      }
                                                    </script>
                                                </form>
                                                @if($loanDevice->is_using)
                                                    <form method="POST"
                                                          action="{{route("loan-device.release", $loanDevice)}}">
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit" class="btn btn-success">Return
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{$loanDevices->appends(request()->input())->links()}}
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
@endsection
