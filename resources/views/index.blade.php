<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Warehouse Management App</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
      <!-- Chart list Js -->
      <link rel="stylesheet" href="{{asset('assets/js/chartist/chartist.min.css')}}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/typography.css')}}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
      <!-- Remixicon -->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
   </head>
   <body class="sidebar-main-active right-column-fixed header-top-bgcolor">
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
               <a href="{{url ('/')}}">
               <div class="iq-light-logo">
                  <div class="iq-light-logo">
                     <img src="{{asset('assets/images/newlogo.png')}}" class="img-fluid" alt="">
                   </div>
                     <div class="iq-dark-logo">
                        <img src="{{asset('assets/images/newlogo.png')}}" class="img-fluid" alt="">
                     </div>
               </div>
               <div class="iq-dark-logo">
                  <img src="{{asset('assets/images/newlogo.png')}}" class="img-fluid" alt="">
               </div>
               </a>
               <div class="iq-menu-bt-sidebar">
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home</span></li>
                     <li class="active">
                        <a href="{{url ('/')}}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
                     </li>

                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Inventory Management</span></li>
                     <li>
                        <a href="{{route ('registitem.create')}}" class="iq-waves-effect" aria-expanded="false"><i class="ri-file-edit-line"></i><span>Register Item</span></a>
                     </li>
                     <li>
                        <a href="{{route ('inventoryin.create')}}" class="iq-waves-effect" aria-expanded="false"><i class="ri-install-fill"></i><span>Inventory In</span></a>
                     </li>
                     <li>
                        <a href="{{route ('inventoryout.create')}}" class="iq-waves-effect"><i class="ri-uninstall-fill"></i><span>Inventory Out</span></a>
                     </li>
                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Inventory Dashboard</span></li>
                     <li>
                        <a href="{{route ('allitem.show')}}" class="iq-waves-effect" aria-expanded="false"><i class="ri-chat-check-line"></i><span>All Items</span></a>
                     </li>
                     <li>
                        <a href="{{route ('orderlist.show')}}" class="iq-waves-effect" aria-expanded="false"><i class="ri-truck-line"></i><span>All Orders</span></a>
                     </li>
                     <li>
                        <a href="{{route ('stockreportinghome')}}" class="iq-waves-effect" aria-expanded="false"><i class="ri-store-line"></i><span>Stock Reporting</span></a>
                     </li>
                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>-</span></li>
                     <li>
                        <a href="{{route ('logout')}}" class="iq-waves-effect" aria-expanded="false" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ri-logout-box-r-line"></i><span>Log Out</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                     </li>
                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
         </div>
         @include('layouts.header')
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-3">
                        <a href="{{route ('inventoryin.create')}}">
                        <div class="iq-card iq-card-block iq-card-stretch ">
                           <div class="iq-card-body">
                                   <div class="d-flex d-flex align-items-center justify-content-between">
                                      <div>
                                          <h2>Inventory In</h2>
                                          <p class="fontsize-sm m-0">Barang Masuk Gudang</p>
                                      </div>
                                      <div class="rounded-circle iq-card-icon dark-icon-light iq-bg-primary "> <i class="ri-install-fill"></i></div>
                                   </div>
                           </div>
                        </div>
                     </a>
                     </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                  <a href="{{route ('inventoryout.create')}}">
                     <div class="iq-card iq-card-block iq-card-stretch ">
                        <div class="iq-card-body">
                           <div class="d-flex d-flex align-items-center justify-content-between">
                              <div>
                                  <h2>Inventory Out</h2>
                                  <p class="fontsize-sm m-0">Barang Keluar Gudang</p>
                              </div>
                              <div class="rounded-circle iq-card-icon iq-bg-danger"><i class="ri-uninstall-fill"></i></div>
                           </div>
                         </div>
                     </div>
                  </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                     <a href="{{route ('allitem.show')}}">
                     <div class="iq-card iq-card-block iq-card-stretch ">
                        <div class="iq-card-body">
                           <div class="d-flex d-flex align-items-center justify-content-between">
                              <div>
                                  <h2>All Items</h2>
                                  <p class="fontsize-sm m-0">Semua Item Terdaftar</p>
                              </div>
                              <div class="rounded-circle iq-card-icon iq-bg-warning "><i class="ri-chat-check-line"></i></div>
                           </div>
                       </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                     <a href="{{route ('orderlist.show')}}">
                     <div class="iq-card iq-card-block iq-card-stretch ">
                        <div class="iq-card-body">
                           <div class="d-flex d-flex align-items-center justify-content-between">
                              <div>
                                  <h2>All Orders</h2>
                                  <p class="fontsize-sm m-0">Semua Order Terbentuk</p>
                              </div>
                              <div class="rounded-circle iq-card-icon iq-bg-info "><i class="ri-truck-line"></i></div>
                           </div>
                       </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                     <a href="{{route ('registitem.create')}}">
                     <div class="iq-card iq-card-block iq-card-stretch ">
                        <div class="iq-card-body">
                                <div class="d-flex d-flex align-items-center justify-content-between">
                                   <div>
                                       <h2>Register Item</h2>
                                       <p class="fontsize-sm m-0">Daftarkan Barang Baru</p>
                                   </div>
                                   <div class="rounded-circle iq-card-icon dark-icon-light iq-bg-secondary "> <i class="ri-file-edit-line"></i></div>
                                </div>
                        </div>
                     </div>
                     </a>
                  </div>

                  <div class="col-sm-6 col-md-6 col-lg-3">
                    <a href="{{route ('stockreportinghome')}}">
                    <div class="iq-card iq-card-block iq-card-stretch ">
                       <div class="iq-card-body">
                          <div class="d-flex d-flex align-items-center justify-content-between">
                             <div>
                                 <h2>All Stock Reporting</h2>
                                 <p class="fontsize-sm m-0">Laporan Stok</p>
                             </div>
                             <div class="rounded-circle iq-card-icon iq-bg-info "><i class="ri-store-line"></i></div>
                          </div>
                      </div>
                    </div>
                    </a>
                 </div>
               </div>
               </div>
         </div>

      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6 text-right">
                  Copyright 2022 All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>


      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->

      <script src="{{asset('assets/js/jquery.min.js')}}"></script>

      <script src="{{asset('assets/js/popper.min.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
      <!-- Appear JavaScript -->
      <script src="{{asset('assets/js/jquery.appear.js')}}"></script>
      <!-- Countdown JavaScript -->
      <script src="{{asset('assets/js/countdown.min.js')}}"></script>
      <!-- Counterup JavaScript -->
      <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
      <!-- Wow JavaScript -->
      <script src="{{asset('assets/js/wow.min.js')}}"></script>
      <!-- Apexcharts JavaScript -->
      <script src="{{asset('assets/js/apexcharts.js')}}"></script>
      <!-- Slick JavaScript -->
      <script src="{{asset('assets/js/slick.min.js')}}"></script>
      <!-- Select2 JavaScript -->
      <script src="{{asset('assets/js/select2.min.js')}}"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="{{asset('assets/js/smooth-scrollbar.js')}}"></script>
      <!-- lottie JavaScript -->
      <script src="{{asset('assets/js/lottie.js')}}"></script>
      <!-- am core JavaScript -->
      <script src="{{asset('assets/js/core.js')}}"></script>
      <!-- am charts JavaScript -->
      <script src="{{asset('assets/js/charts.js')}}"></script>
      <!-- am animated JavaScript -->
      <script src="{{asset('assets/js/animated.js')}}"></script>
      <!-- am kelly JavaScript -->
      <script src="{{asset('assets/js/kelly.js')}}"></script>
      <!-- Morris JavaScript -->
      <script src="{{asset('assets/js/morris.js')}}"></script>
      <!-- am maps JavaScript -->
      <script src="{{asset('assets/js/maps.js')}}"></script>
      <!-- am worldLow JavaScript -->
      <script src="{{asset('assets/js/worldLow.js')}}"></script>
      <!-- ChartList Js -->
      <script src="{{asset('assets/js/chartist/chartist.min.js')}}"></script>
      <!-- Chart Custom JavaScript -->
      <script async src="{{asset('assets/js/chart-custom.js')}}"></script>
      <!-- Custom JavaScript -->
      <script src="{{asset('assets/js/custom.js')}}"></script>
   </body>
</html>
