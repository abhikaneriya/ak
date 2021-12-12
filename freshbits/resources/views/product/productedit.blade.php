@extends('layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Product</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url('product/'.$data->id)}}" id="productform" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                    <div class="form-row">
                                        <div class="col">
                                            <label class="form-label">Name:</label>
                                            <input type="text" name="name" id="name" value="{{$data->name}}"  class="form-control">
                                            <span style="color:red">@error('name'){{$message}}@enderror</span>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Price:</label>
                                            <input type="number" id="price" name="price" value="{{$data->price}}"  class="form-control">
                                            <span style="color:red">@error('price'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label class="form-label">UPC</label>
                                            <input type="number" id="upc" name="upc" value="{{$data->upc}}" class="form-control">
                                            <span style="color:red">@error('upc'){{$message}}@enderror</span>
                                        </div>
                                        <div class="col">
                                            <label for="formFile" class="form-label">Image</label>
                                            <input class="form-control" name="image" type="file" id="formFile">
                                            <span style="color:red">@error('image'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label class="form-label">Status:</label><br>
                                            <input type="radio" name="status" value="1" @if("$data->status"==1  ) checked @endif>Active
                                            <input type="radio" name="status" class="ms-3" value="0" @if("$data->status"==0  ) checked @endif>InActive
                                            <span style="color:red">@error('status'){{$message}}@enderror</span>
                                            </div>
                                        <div class="col">
                                            <img src="{{ asset('storage/uploads/products/'.$data->id.'/'.$data->image) }}" height="70px" width="125px" style="margin-top: 10px">
                                        </div>
                                    </div>

                                    <div class="mb-3">

                                    </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection
