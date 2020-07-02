@extends("layouts.root")

@section("css")
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection

@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Detail</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route("admin") }}" class="btn btn-primary float-right">Back</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <img src="{{$admin->file ?url($admin->file->path) : null}}" id="imgPrev" width="200" height="200"/>
                </div>
                <div class="col-6">
                    <form style="padding-bottom: 1rem" method="POST" action="{{route("admin.store")}}" id="form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="login_id">Login ID</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="text" class="form-control" id="login_id" name="login_id"
                                       placeholder="user..." value="{{$admin->login_id}}">
                                @error('login_id')
                                <div class="invalid-feedback" style="display: block">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name"
                                       name="first_name" placeholder="user..." value="{{$admin->first_name}}">
                            </div>
                            <div class="col">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name"
                                       name="last_name" placeholder="user..." value="{{$admin->last_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"
                                   name="email" placeholder="user..." value="{{$admin->email}}">
                            @error('email')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender">
                                @if($admin->gender == 0)
                                    <option value="0" selected>Male</option>
                                    <option value="1">Female</option>
                                @else
                                    <option value="0">Male</option>
                                    <option value="1" selected>Female</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="address..." value="{{$admin->address}}">
                        </div>
                        <div class="form-group"> <!-- Date input -->
                            <label class="control-label" for="birthday">Birthday</label>
                            <input class="form-control" id="birthday" name="birthday"
                                   placeholder="DD/MM/YYY" type="text" value="{{$admin->birthday}}">
                        </div>
                    </form>
                    <a href="{{route('user.edit',$admin)}}" class="btn btn-outline-primary">Edit</a>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section("script")
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
    <script>
        $(document).ready(function () {
            var birthday = $('input[name="birthday"]'); //our date input has the name "date"
            var start_at = $('input[name="start_at"]');
            var container = $('.content form').length > 0 ? $('.content form').parent() : "body";
            var options = {
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            //birthday.datepicker(options);
            //start_at.datepicker(options);

            //disable all input
            $("#form :input").prop("disabled", true);
        })
    </script>
@endsection
