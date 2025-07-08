<div class="modal fade" id="mobile-nav-drawer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog drawer drawer-start !w-[330px]">
        <div class="drawer-content">
            <div class="drawer-header">
                <h4>Navigation</h4>
                <span class="close-btn" role="button" data-bs-dismiss="modal">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                        aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            </div>
            <div class="drawer-body p-0">
                <div class="side-nav-mobile">
                    <div class="side-nav-content relative side-nav-scroll">
                        <nav class="menu menu-transparent px-4 pb-4">
                            <div class="menu-group">
                                <div class="menu-title">MENU</div>
                                <ul>
                                    <li data-menu-item="modern-welcome"
                                        class="{{ request()->routeIs('dashboard.index') ? 'menu-item menu-item-single mb-2  menu-item-active' : 'menu-item menu-item-single mb-2' }}">
                                        <a class="menu-item-link" href="{{ route('dashboard.index') }}">
                                            <svg class="menu-item-icon" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                                            </svg>
                                            <span class="menu-item-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li
                                        class="{{ request()->segment(1) === 'hospital' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg class="menu-item-icon" stroke="currentColor" fill="none"
                                                stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                </path>
                                            </svg>
                                            <span class="menu-item-text">Add Hospital</span>
                                        </div>
                                        <ul
                                            style="{{ request()->segment(1) === 'hospital' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-help-center"
                                                class="{{ request()->routeIs('hospital.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('hospital.list') }}">
                                                    <span>List of Hospitals</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-article"
                                                class="{{ request()->routeIs('hospital.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('hospital.create') }}">
                                                    <span>Create New</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="{{ request()->segment(1) === 'portfolio' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg class="menu-item-icon" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                            </svg>
                                            <span class="menu-item-text">Portfolio</span>
                                        </div>
                                        <ul
                                            style="{{ request()->segment(1) === 'portfolio' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-dashboard"
                                                class="{{ request()->routeIs('portfolio.list') ? 'menu-item  menu-item-active' : 'menu-item ' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('portfolio.list') }}">
                                                    <span>List of Doctors'</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('portfolio.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('portfolio.create') }}">
                                                    <span>Create New</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="{{ request()->segment(1) === 'link-hospital' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                                class="menu-item-icon" height="1em" width="1em">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244">
                                                </path>
                                            </svg>
                                            <span class="menu-item-text">Link Hospital</span>
                                        </div>
                                        <ul
                                            style="{{ request()->segment(1) === 'link-hospital' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('linked.hospital.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('linked.hospital.list') }}">
                                                    <span>List of Linked Hospitals</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('linked.hospital.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('linked.hospital.create') }}">
                                                    <span>Link With Portfolio</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->segment(1) === 'opd' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true" class="menu-item-icon" height="1em"
                                                width="1em">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="menu-item-text">OPD Schedule</span>
                                        </div>
                                        <ul
                                            style="{{ request()->segment(1) === 'opd' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('opd.get.list.of.schedules') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('opd.get.list.of.schedules') }}">
                                                    <span>List of Schedules</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('opd.set.schedule') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('opd.set.schedule') }}">
                                                    <span>Set Schedule</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->segment(1) === 'lab-test-category' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg class="menu-item-icon" stroke="currentColor" fill="none"
                                                stroke-width="1.5" viewBox="0 0 24 24" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5">
                                                </path>
                                            </svg>
                                            <span class="menu-item-text">Lab Test Category</span>
                                        </div>
                                        <ul
                                            style="{{ request()->segment(1) === 'lab-test-category' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('lab.test.category.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('lab.test.category.list') }}">
                                                    <span>List of Categories</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('lab.test.category.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('lab.test.category.create') }}">
                                                    <span>Create Category</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->segment(1) === 'lab-test' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg class="menu-item-icon" stroke="currentColor" fill="none"
                                                stroke-width="1.5" viewBox="0 0 24 24" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z">
                                                </path>
                                            </svg>
                                            <span class="menu-item-text">Lab Test</span>
                                        </div>
                                        <ul
                                            style="{{ request()->segment(1) === 'lab-test' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('lab.test.get.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('lab.test.get.list') }}">
                                                    <span>List of Tests</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('lab.test.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('lab.test.create') }}">
                                                    <span>Create Test</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->segment(1) === 'lab-test-package' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="1.5"
                                                viewBox="0 0 24 24" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                                            </svg>
                                            <span class="menu-item-text">Lab Test Package</span>
                                        </div>
                                        <ul style="{{ request()->segment(1) === 'lab-test-package' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-list" class="{{ request()->routeIs('lab.package.test.get.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center" href="{{ route('lab.package.test.get.list') }}">
                                                    <span>List of Packages</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list" class="{{ request()->routeIs('lab.test.package.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center" href="{{ route('lab.test.package.create') }}">
                                                    <span>Create Package</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-collapse">
                                        <div class="menu-collapse-item">
                                            <svg class="menu-item-icon" stroke="currentColor" fill="none"
                                                stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <span class="menu-item-text">Appointment</span>
                                        </div>
                                        <ul>
                                            <li data-menu-item="modern-crm-dashboard" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-crm-dashboard.html">
                                                    <span>Dashboard</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-calendar" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-calendar.html">
                                                    <span>Calendar</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-customers" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-customers.html">
                                                    <span>Customers</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-customer-details" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-customer-details.html">
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
                                            <svg class="menu-item-icon" stroke="currentColor" fill="none"
                                                stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="menu-item-text">Consultation</span>
                                        </div>
                                        <ul>
                                            <li data-menu-item="modern-sales-dashboard" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-sales-dashboard.html">
                                                    <span>Dashboard</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-product-list" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-product-list.html">
                                                    <span>Product List</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-product-edit" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-product-edit.html">
                                                    <span>Product Edit</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-new-product" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-new-product.html">
                                                    <span>New Product</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-order-list" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-order-list.html">
                                                    <span>Order List</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-order-details" class="menu-item">
                                                <a class="h-full w-full flex items-center"
                                                    href="modern-order-details.html">
                                                    <span>Order Details</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->segment(1) === 'recent-events' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true" height="1em" width="1em"
                                                class="menu-item-icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z">
                                                </path>
                                            </svg>
                                            <span class="menu-item-text">Recent Events</span>
                                        </div>
                                        <ul
                                            style="{{ request()->segment(1) === 'recent-events' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('recent.events.get.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('recent.events.get.list') }}">
                                                    <span>List of Events</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list"
                                                class="{{ request()->routeIs('recent.events.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center"
                                                    href="{{ route('recent.events.create') }}">
                                                    <span>Create Event</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->segment(1) === 'academic-announcement' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" height="1em" width="1em" class="menu-item-icon">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46"></path>
                                            </svg>
                                            <span class="menu-item-text">Academic Announcements</span>
                                        </div>
                                        <ul style="{{ request()->segment(1) === 'academic-announcement' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-list" class="{{ request()->routeIs('academic.announcements.get.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center" href="{{ route('academic.announcements.get.list') }}">
                                                    <span>List of announcements</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list" class="{{ request()->routeIs('academic.announcements.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center" href="{{ route('academic.announcements.create') }}">
                                                    <span>Create Announcement</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->segment(1) === 'popup-manager' ? 'menu-collapse menu-collapse-item-active' : 'menu-collapse' }}">
                                        <div class="menu-collapse-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" height="1em" width="1em" class="menu-item-icon">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122"></path>
                                            </svg>
                                            <span class="menu-item-text">Pop-up Manager</span>
                                        </div>
                                        <ul style="{{ request()->segment(1) === 'popup-manager' ? 'display:block' : 'display:none' }}">
                                            <li data-menu-item="modern-project-list" class="{{ request()->routeIs('popup.manager.list') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center" href="{{ route('popup.manager.list') }}">
                                                    <span>List of Pop-up's</span>
                                                </a>
                                            </li>
                                            <li data-menu-item="modern-project-list" class="{{ request()->routeIs('popup.manager.create') ? 'menu-item menu-item-active' : 'menu-item' }}">
                                                <a class="h-full w-full flex items-center" href="{{ route('popup.manager.create') }}">
                                                    <span>Create Creative Pop-up</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
