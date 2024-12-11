<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
  </head>
  <body>
    @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')
        <!-- partial -->
        <div style="padding-bottom: 30px;" class="container-fluid page-body-wrapper">
            <div class="container" align="center">

                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table>
                    <tr style="background-color: grey;" align="center">
                        <td style="padding: 20px;">Title</td>
                        <td style="padding: 20px;">Quantity</td>
                        <td style="padding: 20px;">Price</td>
                        <td style="padding: 20px;">Image</td>
                        <td style="padding: 20px;">Update</td>
                        <td style="padding: 20px;">Delete</td>
                    </tr>

                    @foreach($data as $product)
                    <tr align="center" style="background-color: black;">
                        <td style="padding: 20px;">{{$product->title}}</td>
                        <td style="padding: 20px;">{{$product->quantity}}</td>
                        <td style="padding: 20px;">{{$product->price}}</td>
                        <td>
                            <img height="100" width="100" src="/productimage/{{$product->image}}">
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{url('updateview', $product->id)}}">Update</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{url('deleteproduct', $product->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
          <!-- partial -->
          @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>