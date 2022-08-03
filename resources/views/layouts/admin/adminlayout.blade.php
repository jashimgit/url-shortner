<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="backend/img/logo/logo.png" rel="icon">
  <title>Admin - Dashboard</title>
  <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('backend/css/ruang-admin.min.css')}}" rel="stylesheet">
  <link href="{{ asset('backend/toastr/toastr.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('backend/custom.css')}}">


</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    @include('layouts.partials.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        @include('layouts.partials.topbar')
        <!-- Topbar -->

        <!-- Container Fluid-->
        @yield('content')
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; 2019 - developed by
              <b><a href="#" target="_blank">Anonymous</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('backend/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{ asset('backend/js/ruang-admin.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{ asset('backend/js/demo/chart-area-demo.js')}}"></script>

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
  {{-- sweet alert --}}
  <script src="{{ asset('backend/sweetalert.min.js')}}"></script>

  {{-- toaster --}}
  <script src="{{ asset('backend/toastr/toastr.min.js')}}"></script>


  <script>
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        let link = $(this).attr('href');
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                   window.location.href = link;
                } else {
                    swal("Data is safe!");
                }
            });
    });
  </script>

  <script>
    toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type', 'info')}}"
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message')}}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message')}}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message')}}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message')}}");
            break;

    }

    @endif
  </script>

</body>

</html>