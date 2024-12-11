<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        .title {
            padding-top: 25px;
            font-size: 25px;
        }

        label {
            display: inline-block;
            width: 200px;
        }
    </style>
  </head>
  <body>
    @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="container" align="center">
                <h1 class="title">Update Product</h1>

                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{url('updateproduct', $data->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="padding: 15px;">
                        <label>Product Title</label>
                        <input style="color: black;" type="text" name="title" value="{{$data->title}}" required="">
                    </div>
                    <div style="padding: 15px;">
                        <label>Price</label>
                        <input style="color: black;" type="text" name="price" value="{{$data->price}}" required="">
                    </div>
                    <div style="padding: 15px;">
                        <label>Description</label>
                        <input style="color: black;" type="text" name="desc" value="{{$data->description}}" required="">
                    </div>
                    <div style="padding: 15px;">
                        <label>Quantity</label>
                        <input style="color: black;" type="number" name="quantity" value="{{$data->quantity}}" required="">
                    </div>
                    <div style="padding: 15px;">
                        <label>Old Image</label>
                        <img height="100" width="100" src="/productimage/{{$data->image}}">
                    </div>
                    <div style="padding: 15px;">
                        <label>Change the image</label>
                        <input type="file" name="file">
                    </div>
                    <div style="padding: 15px;">
                        <input class="btn btn-success" type="submit">
                    </div>
                </form>
            </div>
        </div>
          <!-- partial -->
          @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>