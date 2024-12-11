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
        <div class="container-fluid page-body-wrapper">
            <div class="container" align="center">
                <table>
                    <tr style="background-color: gray;" align="center">
                        <td style="padding: 20px;">Customer Name</td>
                        <td style="padding: 20px;">Phone</td>
                        <td style="padding: 20px;">Address</td>
                        <td style="padding: 20px;">Product Name</td>
                        <td style="padding: 20px;">Price</td>
                        <td style="padding: 20px;">Quantity</td>
                        <td style="padding: 20px;">Status</td>
                        <td style="padding: 20px;">Action</td>
                    </tr>

                    @foreach($order as $orders)
                    <tr style="background-color: black;" align="center">
                        <td style="padding: 20px;">{{$orders->name}}</td>
                        <td style="padding: 20px;">{{$orders->phone}}</td>
                        <td style="padding: 20px;">{{$orders->address}}</td>
                        <td style="padding: 20px;">{{$orders->product_name}}</td>
                        <td style="padding: 20px;">Rp{{$orders->price}}</td>
                        <td style="padding: 20px;">{{$orders->quantity}}</td>
                        <td style="padding: 20px;">{{$orders->status}}</td>
                        <td style="padding: 20px;">
                            @if($orders->status == 'Delivered')
                                <a class="btn btn-success disabled" href="#" tabindex="-1" aria-disabled="true">Delivered</a>
                            @else
                                <a class="btn btn-success" href="{{ url('updatestatus', $orders->id) }}">Deliver</a>
                            @endif
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