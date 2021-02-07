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
                    <h1>Tag Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tag</li>
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
                        <span>Delete tag #{{Session::get('success')->type}}[{{Session::get('success')->value}}] successfully!</span>
                    </div>
                </div>
            @endif
            <div class="row" style="margin-bottom: 1rem">
                <div class="col-6">
                    <a type="button" href="{{route("tag.create")}}" class="btn btn-outline-primary">Add new</a>
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
                            <form name="filter" action="{{route("tag.search")}}" method="GET">
                                <h6 class="mb-3 text-bold">Tag Information</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="type" placeholder="Type"
                                           value="{{old("type")}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="value" placeholder="Value"
                                           value="{{old("value")}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="description" placeholder="Description"
                                           value="{{old("description")}}">
                                </div>
                                <div class="row form-group">
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
                                    <th class="sorting">Type</th>
                                    <th class="sorting">Value</th>
                                    <th class="sorting">Description</th>
                                    <th class="sorting">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr id="{{$tag->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$tag->type}}</td>
                                        <td>{{$tag->value}}</td>
                                        <td>{{$tag->description}}</td>
                                        <td>
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                More
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route("tag.edit", $tag)}}">Edit</a>
                                                <form method="POST" onSubmit="return confirmDelete();"
                                                      action="{{route("tag.delete", $tag)}} ">
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
