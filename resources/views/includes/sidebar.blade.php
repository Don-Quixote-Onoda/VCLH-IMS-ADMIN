        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="/" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>VCWAMS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('admin_assets/img/user.jpg') }}" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->role == 1 ? 'Administrator' : 'Manager' }}</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    @if (Auth::user()->role == 1)
                        {{-- <a href="/admin/dashboard"
                            class="nav-item nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Dashboard</a> --}}
                        <a href="/admin/users-admin"
                            class="nav-item nav-link {{ request()->is('admin/users-admin') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>User</a>
                        <a href="/admin/dashboard"
                            class="nav-item nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Inns</a>
                                
                    @endif
                    @if (Auth::user()->role == 2)
                        
                        <a href="/user/dashboard"
                            class="nav-item nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}"><i
                                class="fa fa-solid fa-hotel me-2"></i>Rooms</a>
                        <a href="/user/transactions-manager"
                            class="nav-item nav-link {{ request()->is('user/transactions-manager') ? 'active' : '' }}"><i
                                class="fa fa-money-check-alt me-2"></i>Transactions</a>
                              
                        <a href="/user/reservations-manager"
                            class="nav-item nav-link {{ request()->is('user/reservations-manager') ? 'active' : '' }}"><i
                                class="fa fa-bed me-2"></i>Reservation</a>
                        
                                <!-- <a href="/user/summary-reports"
                            class="nav-item nav-link {{ request()->is('summary-reports') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Summary Reports</a> -->
                        <a class="dropdown nav-item nav-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i
                                class="fa fa-calculator me-2"></i>POS/Inv
                          
                            
                        </a>
                        <a href="/user/products/" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            <i class="fa fa-shopping-bag me-2"></i>Products
                            
                        </a>
                        <a href="/user/products-category/" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            <i class="fa fa fa-tags me-2"></i>Category

                            
                        </a>

                        <!-- <a href="/user/order-details/" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Order Details
                        </a>
                        <a href="/user/order-summary/" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Order Summary
                        </a> -->
                        <a href="/user/inventory-management/" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Inventory Management
                        </a>

                        <a href="/user/transaction-history/" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Transaction History
                        </a>

    </a>     
                        

                            
                    @endif
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
