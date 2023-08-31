    @extends('layouts.admin_app')

    @section('main_section')

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('assets')}}/dist/img/bidyaan_logo.png" alt="AdminLTELogo" height="200" width="200">
  </div>

  <!-- Navbar -->
    @includeIf('partials.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @includeIf('partials.sidebar')
  <!-- / Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  

    <!-- Main content -->
    <section class="content " style="margin-top: 75px;">
      <div class="container-fluid" >
        <!-- Info boxes -->
        <!-- <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
              
            </div>
           
          </div>
         
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
              </div>
           
            </div>
         
          </div>
      

         
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
              </div>
             
            </div>
       
          </div>
        
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
              </div>
       
            </div>
     
          </div>
 
        </div> -->
        <!-- /.row -->

        <div class="row" >
          <div class="col-md-12" >
            <div class="card" style="min-height: 650px; border-radius:3px;">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>   
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">

                    @yield('main_content')

                
                </div>
                <!-- /.row -->
              </div>
             
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
   
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar and Footer -->
    @includeIf('partials.footer')
  <!-- /.control-sidebar and Footer -->
    @stop