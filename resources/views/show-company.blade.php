@extends("layouts.root")

@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Company Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Company</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Logo</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{$company->file->path}}" id="imgPrev" width="200"
                                 height="200"/>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="login_id">Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{$company->name}}" readonly>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="first_name">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           value="{{$company->address}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="last_name">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{$company->phone}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{$company->email}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" class="form-control" id="url" name="url"
                                       value="{{$company->url}}" readonly>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

