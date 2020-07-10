@extends("layouts.root")

@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Setting general</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                    <div class="col-6">
                        <div class="alert alert-success" role="alert">
                            <span>{{Session::get('success')}}</span>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form style="padding-bottom: 1rem" method="POST" action="{{route("setting.update")}}"
                                  id="form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row form-group">
                                    <label class="col-12" for="login_id">Logo</label>
                                    <div class="col">
                                        <img src="{{$settings['logo']}}" id="imgPrev" width="200"
                                             height="200"/>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="file" class="custom-file-input"
                                                   id="img" name="img" form="form">
                                            <label class="custom-file-label" for="img" id="nameAvatar">Choose
                                                image</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" class="form-control" id="name" name="name" value="{{$settings['name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="footer">Footer signature</label>
                                    <input type="text" class="form-control" id="footer" name="footer" value="{{$settings['footer']}}">
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('script')
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