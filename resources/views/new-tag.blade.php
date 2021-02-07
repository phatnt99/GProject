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
                    <h1>Add new tag</h1>
                </div>
                <div class="col-sm-6">
                    <a href=" {{route("tag")}}" class="btn btn-primary float-right">Back</a>
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
                        <span>New tag <b>#{{Session::get('success')->type}}</b> with value #<b>{{Session::get('success')->value}}</b> has been added!</span>
                    </div>
                </div>
            @endif
            <div class="col-6">
                <form style="padding-bottom: 1rem" method="POST" action="{{route("tag.store")}}" id="form">
                    @csrf
                    <div class="form-group">
                        <label for="login_id">Type<span style="color: red">(*)</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="type" name="type" value="{{old('type')}}">
                            @error('type')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login_id">Value<span style="color: red">(*)</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="value" name="value" value="{{old('value')}}">
                            @error('value')
                            <div class="invalid-feedback" style="display: block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login_id">Description</label>
                        <div class="input-group">
                            <textarea type="text" class="form-control" id="description" name="description"
                                      value="{{old('description')}}"></textarea>
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
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
@endsection
