<!-- Top Navbar -->
<div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <div class="iq-sidebar-logo">
                  <div class="top-logo">
                     <a href="{{url ('/')}}" class="logo">
                     <div class="iq-light-logo">
                  <img src="{{asset('assets/images/newlogo.png')}}" class="img-fluid" alt="">
               </div>
               <div class="iq-dark-logo">
                  <img src="{{asset('assets/images/newlogo.png')}}" class="img-fluid" alt="">
               </div>
                     </a>
                  </div>
               </div>
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="navbar-left">
                  <ul id="topbar-data-icon" class="d-flex p-0 topbar-menu-icon">
                     <li class="nav-item">
                        <a href="{{route ('inventoryin.create')}}" class="nav-link"><i class="ri-install-fill"></i></a>
                     </li>
                     <li>
                        <a href="{{route ('inventoryout.create')}}" class="nav-link"><i class="ri-uninstall-fill"></i></a>
                     </li>
                     <li>
                        <a href="{{route ('allitem.show')}}" class="nav-link"><i class="ri-chat-check-line"></i></a>
                     </li>
                     <li>
                        <a href="{{route ('orderlist.show')}}" class="nav-link"><i class="ri-truck-line"></i></a>
                     </li>
                  </ul>
               </div>
                  <button class="navbar-toggler wrapper-menu" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                  <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                  </button>
                  <ul class="navbar-list">
                     <li>
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                           <img src="{{asset('assets/images/newlogo.png')}}" class="img-fluid rounded mr-3" alt="">
                           <div class="caption">
                              <h6 class="mb-0 line-height text-white">Warehouse Management App</h6>
                           </div>
                        </a>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>