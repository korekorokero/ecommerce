<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Toko Online</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <h2>Toko <em>Online</em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Kontak</a>
                        </li>

                        @if (Route::has('login'))
                        @auth
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('showcart')}}">Keranjang [{{$count}}]</a>
                            <span class="sr-only">(current)</span>
                        </li>
                        <x-app-layout>

                        </x-app-layout>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                        </li>
                        @endif
                        @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @if(session()->has('message'))
            <div class="px-5">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    </header>

    <div class="table-responsive" style="padding-top: 150px; padding-bottom: 100px; padding-left: 100px; padding-right: 100px;" align="center">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <td style="padding: 10px; font-size: 20px;" align="center">Nama Produk</td>
                    <td style="padding: 10px; font-size: 20px;" align="center">Jumlah</td>
                    <td style="padding: 10px; font-size: 20px;" align="center">Harga</td>
                    <td style="padding: 10px; font-size: 20px;" align="center">Pilihan</td>
                </tr>
            </thead>

            <form action="{{url('order')}}" method="POST">
                @csrf
                @foreach($cart as $carts)
                <tr>
                    <td style="padding: 10px;" align="center">
                        <input type="text" name="productname[]" value="{{$carts->product->title}}" hidden>
                        {{$carts->product->title}}
                    </td>
                    <td style="padding: 10px;" align="center">
                        <input type="text" name="quantity[]" value="{{$carts->quantity}}" hidden>
                        {{$carts->quantity}}
                    </td>
                    <td style="padding: 10px;" align="center">
                        <input type="text" name="price[]" value="{{number_format(str_replace(['.', ','], '', $carts->product->price) * $carts->quantity, 0, ',', '.')}}" hidden>
                        Rp{{number_format(str_replace(['.', ','], '', $carts->product->price) * $carts->quantity, 0, ',', '.')}}
                    </td>
                    <td style="padding: 10px;" align="center"><a class="btn btn-danger" href="{{url('delete', $carts->id)}}">Hapus</a></td>
                </tr>
                @endforeach
            </table>
            
            @if($cart->count() > 0)
            <button class="btn btn-success">Konfirmasi Pesanan</button>
            @endif
        </form>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>


</body>

</html>