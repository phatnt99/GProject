@extends("layouts.root")

@section("css")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection

@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add loan device</h1>
                </div>
                <div class="col-sm-6">
                    <a href=" {{route("loan-device")}}" class="btn btn-primary float-right">Back</a>
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
                        <span>New loan device <b>#{{Session::get('success')["device"]}}</b> for user <b>#{{Session::get('success')["user"]}}</b> has been added!</span>
                    </div>
                </div>
            @endif
            <div class="col-6">
                <form style="padding-bottom: 1rem" method="GET" action="{{route("loan-device.create")}}" id="form_search">
                    <div class="row form-group">
                        <div class="col">
                            <label for="company_id">Company</label>
                            <div class="form-row">
                                <div class="col">
                                    <div class="input-group">
                                        <select class="form-control" id="company_id" name="company_id">
                                            <option value="" {{old("company_id") == null ? "selected": null}}>All</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}" {{old('company_id') == $company->id ? "selected" : null}}>{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <div class="invalid-feedback" style="display: block">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary float-right">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form style="padding-bottom: 1rem" method="POST" action="{{route("loan-device.store")}}" id="form" >
                    @csrf
                    <div class="form-group">
                        <label for="user_id">User<span style="color: red">(*)</span></label>
                        <div class="input-group">
                            <select class="form-control" id="user_id" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="device_id">Device<span style="color: red">(*)</span></label>
                        <div class="input-group">
                            <select class="form-control" id="device_id" name="device_id">
                                @foreach($devices as $device)
                                    <option value="{{$device->id}}">{{$device->name}}</option>
                                @endforeach
                            </select>
                            @error('device_id')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section("script")
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
@endsection
