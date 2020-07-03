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
                        <li class="breadcrumb-item active">Device</li>
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
                    <a type="button" href="{{route("device.create")}}" class="btn btn-outline-primary">Add new
                        device</a>
                </div>
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
                            <form name="filter" action="{{route("device.search")}}" method="GET">
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
                                        <select class="form-control" id="company_id" name="company_id">
                                            <option value="" {{old("company_id") == null ? "selected": null}}>All
                                            </option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}" {{old('company_id') == $company->id ? "selected" : null}}>{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        <input type="number" class="form-control" name="min_price"
                                               placeholder="Min price" value="{{old("min_price")}}">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="max_price"
                                               placeholder="Max price" value="{{old("max_price")}}">
                                    </div>
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
                                    <th class="sorting">Company</th>
                                    <th class="sorting">Image</th>
                                    <th class="sorting">Status</th>
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
                                        <td>{{$device->company ? $device->company->name : null}}</td>
                                        <td><img width="70px" height="70px"
                                                 src="{{$device->file ?url($device->file->path) : null}}"/></td>
                                        <td>
                                            @if($device->status)
                                                <div class="alert alert-danger text-center" role="alert">using</div>
                                            @else
                                                <div class="alert alert-success text-center" role="alert">available</div>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                More
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="{{route("device.edit", $device)}}">Edit</a>
                                                <form method="POST" onSubmit="return confirmDelete();"
                                                      action="{{route("device.delete", $device)}}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                    <script>
                                                      function confirmDelete () {
                                                        return confirm('Xác nhận xóa?')
                                                      }
                                                    </script>
                                                </form>
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
