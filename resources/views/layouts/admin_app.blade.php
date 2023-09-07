<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Bidyaan central panel')</title>
  <link rel="icon" href="https://v2.bidyaan.com/assets/uploads//logo/1612167490-favicon-icon.png" type="image/x-icon" />            
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets')}}/dist/css/adminlte.min.css">
  <script src="{{asset('assets')}}/plugins/jquery/jquery.min.js"></script>
   <!-- DataTables -->
   <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  @stack('css')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @yield('main_section')
  

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->



<script src="https://cdn.jsdelivr.net/npm/axios@1.5.0/dist/axios.min.js"></script>


<!-- Bootstrap -->
<script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('assets')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('assets')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('assets')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
            //    Data table script 
            $(document).ready (function () {
                $("#datatable_1").DataTable({
                    "responsive": true,
                    "lengthChange": false, 
                    "autoWidth": false,
                    "bDestroy": false,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    "buttons": ["csv", "excel", "pdf", "print", ]

                    }).buttons().container().appendTo('#datatable_1_wrapper .col-md-6:eq(0)');

                    $('#datatable_2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "buttons": "",
                    "ordering": true,
                    "info": true,
                    "bDestroy": false,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
            

           
        </script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('assets')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{asset('assets')}}/plugins/raphael/raphael.min.js"></script>
<script src="{{asset('assets')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{asset('assets')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('assets')}}/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets')}}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets')}}/dist/js/pages/dashboard2.js"></script>



@stack('js')

</body>
</html>
