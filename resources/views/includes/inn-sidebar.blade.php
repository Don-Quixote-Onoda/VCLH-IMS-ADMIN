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
     
                        <a href="/admin/inn/dashboard/{{$id}}"
                            class="nav-item nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a href="/admin/inn/rooms/{{$id}}"
                            class="nav-item nav-link {{ request()->is('user/rooms-manager') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Rooms</a>
                        <a href="/admin/inn/transactions/{{$id}}"
                            class="nav-item nav-link {{ request()->is('user/transactions-manager') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Transactions</a>
                        <a href="/admin/inn/reservations/{{$id}}"
                            class="nav-item nav-link {{ request()->is('user/reservations-manager') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Reservation</a>


                        <a class="dropdown nav-item nav-link" data-bs-toggle="collapse" href="#collapseExample"
                            role="button" aria-expanded="false" aria-controls="collapseExample"><i
                                class="fa fa-tachometer-alt me-2"></i>POS/Inv
                            <i class="fa fa-caret-down bg-transparent"></i>

                        </a>
                        <a href="/admin/inn/products/{{$id}}" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Products
                        </a>
                        <a href="/admin/inn/product_categories/{{$id}}" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Products Category
                        </a>

                        <a href="/admin/inn/order_details/{{$id}}" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Order Details
                        </a>
                        <a href="/admin/inn/order_summaries/{{$id}}" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Order Summary
                        </a>
                        <a href="/admin/inn/inventory_managements/{{$id}}" class="collapse  nav-item nav-link {{ request()->is('#') ? 'active' : '' }}"
                            id="collapseExample">
                            Inventory Management
                        </a>

                        </a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
