<div class="side-nav side-nav-transparent side-nav-expand">
    <div class="side-nav-header">
        <div class="logo px-6">
            <img src="{{ asset('assets/img/logo/swagat-logo.png') }}" alt="Swagat logo">
        </div>
    </div>
    <div class="side-nav-content relative side-nav-scroll">
        <nav class="menu menu-transparent px-4 pb-4">
            <div class="menu-group">
                <div class="menu-title">MENU</div>
                <ul>
                    <li data-menu-item="modern-welcome" class="{{ request()->routeIs('dashboard.index')  ? 'menu-item menu-item-single mb-2  menu-item-active' : 'menu-item menu-item-single mb-2' }}">
                        <a class="menu-item-link" href="{{ route('dashboard.index') }}">
                            <svg class="menu-item-icon" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            <span class="menu-item-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->segment(1) === 'hospital' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                        <div class="menu-collapse-item">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="menu-item-text">Hospital</span>
                        </div>
                        <ul style="{{ request()->segment(1) === 'hospital' ? 'display:block' : 'display:none' }}">
                            <li data-menu-item="modern-help-center" class="{{ request()->routeIs('hospital.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                <a class="h-full w-full flex items-center" href="{{ route('hospital.list') }}">
                                    <span>List of Hospitals</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-article" class="{{ request()->routeIs('hospital.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                <a class="h-full w-full flex items-center" href="{{ route('hospital.create') }}">
                                    <span>Create</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->segment(1) === 'portfolio' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                        <div class="menu-collapse-item">
                            <svg class="menu-item-icon" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                            </svg>
                            <span class="menu-item-text">Portfolio</span>
                        </div>
                        <ul style="{{ request()->segment(1) === 'portfolio' ? 'display:block' : 'display:none' }}">
                            <li data-menu-item="modern-project-dashboard" class="{{ request()->routeIs('portfolio.list')  ? 'menu-item  menu-item-active' : 'menu-item ' }}">
                                <a class="h-full w-full flex items-center" href="{{ route('portfolio.list') }}">
                                    <span>List of Doctors'</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-project-list" class="{{ request()->routeIs('portfolio.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                <a class="h-full w-full flex items-center" href="{{ route('portfolio.create') }}">
                                    <span>Create</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-project-list" class="{{ request()->routeIs('portfolio.hospital.assign') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                <a class="h-full w-full flex items-center" href="{{ route('portfolio.hospital.assign') }}">
                                    <span>Assign New Hospital</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-collapse">
                        <div class="menu-collapse-item">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0"
                                viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span class="menu-item-text">Appointment</span>
                        </div>
                        <ul>
                            <li data-menu-item="modern-crm-dashboard" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-crm-dashboard.html">
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-calendar" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-calendar.html">
                                    <span>Calendar</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-customers" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-customers.html">
                                    <span>Customers</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-customer-details" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-customer-details.html">
                                    <span>Customer Details</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-mail" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-mail.html">
                                    <span>Mail</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-collapse">
                        <div class="menu-collapse-item">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="menu-item-text">Consultation</span>
                        </div>
                        <ul>
                            <li data-menu-item="modern-sales-dashboard" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-sales-dashboard.html">
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-product-list" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-product-list.html">
                                    <span>Product List</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-product-edit" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-product-edit.html">
                                    <span>Product Edit</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-new-product" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-new-product.html">
                                    <span>New Product</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-order-list" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-order-list.html">
                                    <span>Order List</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-order-details" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-order-details.html">
                                    <span>Order Details</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-collapse">
                        <div class="menu-collapse-item">
                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0"
                                viewBox="0 0 24 24" height="1em" width="1em"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span class="menu-item-text">Lab Test</span>
                        </div>
                        <ul>
                            <li data-menu-item="modern-crypto-dashboard" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-crypto-dashboard.html">
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-portfolio" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-portfolio.html">
                                    <span>Portfolio</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-market" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-market.html">
                                    <span>Market</span>
                                </a>
                            </li>
                            <li data-menu-item="modern-wallets" class="menu-item">
                                <a class="h-full w-full flex items-center" href="modern-wallets.html">
                                    <span>Wallets</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
