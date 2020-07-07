@extends("layouts.root")

@section("css")
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection

@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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
                @if(Session::has('success'))
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            <span>{{Session::get('success')}}</span>
                        </div>
                    </div>
                @endif
                <div class="col-lg-3">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Avatar</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{$admin->file->path ?? $user->file->path}}" id="imgPrev" width="200" height="200"/>
                        </div>
                        <div class="card-footer">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"
                                       id="img" name="img" form="form">
                                <label class="custom-file-label" for="img" id="nameAvatar">Choose image</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Information</h5>
                        </div>
                        @if(isset($admin))
                            <div class="card-body">
                                <form style="padding-bottom: 1rem" method="POST" action="{{route('profile.update')}}" id="form"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$admin->id}}">
                                    <div class="form-group">
                                        <label for="login_id">Login ID</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                            </div>
                                            <input type="text" class="form-control" id="login_id" name="login_id"
                                                   value="{{$admin->login_id}}">
                                            @error('login_id')
                                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                   value="{{$admin->first_name}}">
                                        </div>
                                        <div class="col">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                   value="{{$admin->last_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{$admin->email}}">
                                        @error('email')
                                        <div class="invalid-feedback" style="display: block">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            @if($admin->gender == "Male")
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
                                               value="{{$admin->address}}">
                                    </div>
                                    <div class="form-group"> <!-- Date input -->
                                        <label class="control-label" for="birthday">Birthday</label>
                                        <input class="form-control" id="birthday" name="birthday" placeholder="DD/MM/YYY" type="text"
                                               value="{{$admin->birthday}}"/>
                                        @error('birthday')
                                        <div class="invalid-feedback" style="display: block">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        @else
                            <div class="card-body">
                                <form style="padding-bottom: 1rem" method="POST" action="{{route("user.store")}}"
                                      id="form"
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
                                                   name="first_name" placeholder="user..."
                                                   value="{{$admin->first_name}}">
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
                        @endif
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('script')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script>
      $(document).ready(function () {
        var birthday = $('input[name="birthday"]') //our date input has the name "date"
        var start_at = $('input[name="start_at"]')
        var end_at = $('input[name="end_at"]')
        var container = $('.content form').length > 0 ? $('.content form').parent() : 'body'
        var options = {
          format: 'dd/mm/yyyy',
          container: container,
          todayHighlight: true,
          autoclose: true,
        }
        birthday.datepicker(options)
        start_at.datepicker(options)
        end_at.datepicker(options)
      })
    </script>
    <script type="text/javascript">
      $(document).ready(function () {
        //
        $('#img').change(function () {
          var img = this.files[0]
          $('#nameAvatar').text(img.name)
          var reader = new FileReader()

          reader.onload = function (e) {
            $('#imgPrev').attr('src', e.target.result)
          }

          reader.readAsDataURL(this.files[0])
        })
      })
    </script>
@endsection
