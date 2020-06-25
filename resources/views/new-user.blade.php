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
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url()->previous() }}" class="btn btn-primary float-right">Back</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            @if(Session::has('success'))
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    <span>New user <b>#{{Session::get('success')}}</b> has been added!</span>
                </div>
            </div>
            @endif
            <div class="col-6">
                <form style="padding-bottom: 1rem" method="POST" action="{{route("user.store")}}" id="form" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label for="login_id">Login ID</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" id="login_id" name="login_id">
                            @error('login_id')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name">
                        </div>
                        <div class="col">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                        <div class="invalid-feedback" style="display: block">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        @error('email')
                        <div class="invalid-feedback" style="display: block">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group"> <!-- Date input -->
                        <label class="control-label" for="birthday">Birthday</label>
                        <input class="form-control" id="birthday" name="birthday" placeholder="DD/MM/YYY" type="text"/>
                    </div>
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" id="code" name="code">
                        @error('code')
                        <div class="invalid-feedback" style="display: block">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <select class="form-control" id="company_id" name="company_id">
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" name="position">
                    </div>
                    <div class="form-group"> <!-- Date input -->
                        <label class="control-label" for="start_at">Start at</label>
                        <input class="form-control" id="start_at" name="start_at" placeholder="DD/MM/YYY" type="text"/>
                        @error('start_at')
                        <div class="invalid-feedback" style="display: block">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="start_at">Avatar upload</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"
                                   id="avatar" name="avatar">
                            <label class="custom-file-label" for="avatar" id="nameAvatar">Choose image</label>
                        </div>
                        <img src="https://dummyimage.com/200x200/000/fff" id="imgPrev" width="200" height="200"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
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
    <script>
        $(document).ready(function(){
            var birthday=$('input[name="birthday"]'); //our date input has the name "date"
            var start_at=$('input[name="start_at"]');
            var container=$('.content form').length>0 ? $('.content form').parent() : "body";
            var options={
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            birthday.datepicker(options);
            start_at.datepicker(options);
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    avatar: {
                        validators: {
                            file: {
                                extension: 'jpeg,png,jpg',
                                type: 'image/jpeg,image/png,image/jpg',
                                message: 'The selected file is not valid'
                            }
                        }
                    }
                }
            });

            //
            $('#avatar').change(function () {
                var img = this.files[0];
                $('#nameAvatar').text(img.name);
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPrev').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            })
        });
    </script>
@endsection
