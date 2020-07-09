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
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route("company") }}" class="btn btn-primary float-right">Back</a>
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
                        <span>Update company <b>#{{Session::get('success')}}</b> successfully!</span>
                    </div>
                </div>
            @endif
            <div class="col-6">
                <form style="padding-bottom: 1rem" method="POST" action="{{route("company.update", $company)}}"
                      id="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$company->id}}">
                    <div class="form-group">
                        <label for="login_id">Name<span style="color: red">(*)</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" required
                                   value="{{$company->name}}">
                            @error('name')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="first_name">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{{$company->address}}">
                            </div>
                            <div class="col">
                                <label for="last_name">Phone</label>
                                <input type="tel" pattern="[0-9]{1,9}" class="form-control" id="phone" name="phone"
                                       placeholder="0123456789" value="{{$company->phone}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Email<span style="color: red">(*)</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{$company->email}}">
                        @error('email')
                        <div class="invalid-feedback" style="display: block">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Url</label>
                        <input type="text" class="form-control" id="url" name="url"
                               value="{{$company->url}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="start_at">Logo upload</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"
                                   id="img" name="img" value="{{$company->logo}}">
                            <label class="custom-file-label" for="img" id="nameLogo">Choose image</label>
                        </div>
                        <img src="{{$company->file ?url($company->file->path) : null}}" id="imgPrev" width="200" height="200"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
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
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
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
        $('#form').bootstrapValidator({
          feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh',
          },
          fields: {
            avatar: {
              validators: {
                file: {
                  extension: 'jpeg,png,jpg',
                  type: 'image/jpeg,image/png,image/jpg',
                  message: 'The selected file is not valid',
                },
              },
            },
          },
        })

        //
        $('#img').change(function () {
          var img = this.files[0]
          $('#nameLogo').text(img.name)
          var reader = new FileReader()

          reader.onload = function (e) {
            $('#imgPrev').attr('src', e.target.result)
          }

          reader.readAsDataURL(this.files[0])
        })
      })
    </script>
@endsection
