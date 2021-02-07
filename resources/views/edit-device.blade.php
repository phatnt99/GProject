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
                    <h1>Edit Device</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route("device") }}" class="btn btn-primary float-right">Back</a>
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
                        <span>Update device <b>#{{Session::get('success')}}</b> successfully!</span>
                    </div>
                </div>
            @endif
            <div class="col-6">
                <form style="padding-bottom: 1rem" method="POST" action="{{route("device.update", $device)}}"
                      id="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$device->id}}">
                    <div class="form-group">
                        <label for="code">Code<span style="color: red">(*)</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="code" name="code" required
                                   value="{{$device->code}}">
                            @error('code')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name<span style="color: #ff0000">(*)</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" required
                                   value="{{$device->name}}">
                            @error('name')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price"
                               value="{{$device->price}}">
                    </div>
                    <div class="form-group">
                        <label for="company_id">Company</label>
                        <select class="form-control" id="company_id" name="company_id">
                            @foreach($companies as $company)
                                @if($device->company_id == $company->id)
                                    <option value="{{$company->id}}" selected>{{$company->name}}</option>
                                @else
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="start_at">Image upload</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"
                                   id="img" name="img">
                            <label class="custom-file-label" for="img" id="nameLogo">Choose image</label>
                        </div>
                        <img src="{{$device->file ?url($device->file->path) : null}}" id="imgPrev" width="200" height="200"/>
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
