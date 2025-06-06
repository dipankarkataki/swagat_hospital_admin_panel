<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>
        @yield('title') | Swagat Hospital Admin Panel
    </title>

    <!-- Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-styles.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.css"
        integrity="sha512-WnmDqbbAeHb7Put2nIAp7KNlnMup0FXVviOctducz1omuXB/hHK3s2vd3QLffK/CvvFUKrpioxdo+/Jo3k/xIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @yield('custom-style')

</head>

<body>

    <div id="root">
        <!-- App Layout-->
        <div class="app-layout-modern flex flex-auto flex-col">
            <div class="flex flex-auto min-w-0">
                <!-- Side Nav start-->
                @include('layout.sidebar.sidebar')
                <!-- Side Nav end-->

                <!-- Header Nav start-->
                <div
                    class="flex flex-col flex-auto min-h-screen min-w-0 relative w-full bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700">
                    @include('layout.header.header')
                    <!-- Popup start -->
                    {{-- <div class="modal fade" id="nav-config" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog drawer drawer-end">
                            <div class="drawer-content">
                                <div class="drawer-header">
                                    <h4>Theme Config</h4>
                                    <span class="close-btn close-btn-default" role="button" data-bs-dismiss="modal">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                            viewBox="0 0 20 20" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="drawer-body">
                                    <div class="flex flex-col h-full justify-between">
                                        <div class="flex flex-col gap-y-10 mb-6">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h6>Dark Mode</h6>
                                                    <span>Switch theme to dark mode</span>
                                                </div>
                                                <div>
                                                    <label class="switcher">
                                                        <input name="dark-mode-toggle" type="checkbox" value="">
                                                        <span class="switcher-toggle"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h6>Direction</h6>
                                                    <span>Select a direction</span>
                                                </div>
                                                <div class="input-group">
                                                    <button id="dir-ltr-button"
                                                        class="btn btn-default btn-sm btn-active">
                                                        LTR
                                                    </button>
                                                    <button id="dir-rtl-button"
                                                        class="btn bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 active:bg-gray-100 dark:active:bg-gray-500 dark:active:border-gray-500 text-gray-600 dark:text-gray-100 radius-round h-9 px-3 py-2 text-sm">
                                                        RTL
                                                    </button>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-3">Nav Mode</h6>
                                                <div class="inline-flex">
                                                    <label class="radio-label inline-flex mr-3"
                                                        for="nav-mode-radio-default">
                                                        <input id="nav-mode-radio-default" type="radio"
                                                            value="default" name="nav-mode-radio-group"
                                                            class="radio text-primary-600" checked>
                                                        <span>Default</span>
                                                    </label>
                                                    <label class="radio-label inline-flex mr-3"
                                                        for="nav-mode-radio-themed">
                                                        <input id="nav-mode-radio-themed" type="radio" value="themed"
                                                            name="nav-mode-radio-group" class="radio text-primary-600">
                                                        <span>Themed</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-3">Nav Mode</h6>
                                                <select id="theme-select"
                                                    class="input input-sm focus:ring-primary-600 focus-within:ring-primary-600 focus-within:border-primary-600 focus:border-primary-600">
                                                    <option value="primary" selected>Indigo</option>
                                                    <option value="red">Red</option>
                                                    <option value="orange">Orange</option>
                                                    <option value="amber">Amber</option>
                                                    <option value="yellow">Yellow</option>
                                                    <option value="lime">Lime</option>
                                                    <option value="green">Green</option>
                                                    <option value="emerald">Emerald</option>
                                                    <option value="teal">Teal</option>
                                                    <option value="cyan">Cyan</option>
                                                    <option value="sky">Sky</option>
                                                    <option value="blue">Blue</option>
                                                    <option value="violet">Violet</option>
                                                    <option value="purple">Purple</option>
                                                    <option value="fuchsia">Fuchsia</option>
                                                    <option value="pink">Pink</option>
                                                    <option value="rose">Rose</option>
                                                </select>
                                            </div>
                                            <div>
                                                <h6 class="mb-3">Layout</h6>
                                                <div class="segment w-full">
                                                    <div class="grid grid-cols-3 gap-4 w-full">
                                                        <div class="text-center" id="layout-classic">
                                                            <div
                                                                class="flex items-center border rounded-md border-gray-200 dark:border-gray-600 cursor-pointer select-none w-100 hover:ring-1 hover:ring-primary-600 hover:border-primary-600 relative min-h-[80px] w-full">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/classic.jpg') }}"
                                                                    alt="" class="rounded-md dark:hidden">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/classic-dark.jpg') }}"
                                                                    alt="" class="rounded-md hidden dark:block">
                                                            </div>
                                                            <div class="mt-2 font-semibold">Classic</div>
                                                        </div>
                                                        <div class="text-center" id="layout-modern">
                                                            <div
                                                                class="flex items-center border rounded-md dark:border-gray-600 cursor-pointer select-none w-100 ring-1 ring-primary-600 border-primary-600 hover:ring-1 hover:ring-primary-600 hover:border-primary-600 relative min-h-[80px] w-full">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/modern.jpg') }}"
                                                                    alt="" class="rounded-md dark:hidden">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/modern-dark.jpg') }}"
                                                                    alt=""
                                                                    class="rounded-md hidden dark:block">
                                                                <svg stroke="currentColor" fill="currentColor"
                                                                    stroke-width="0" viewBox="0 0 20 20"
                                                                    class="text-primary-600 absolute top-2 right-2 text-lg"
                                                                    height="1em" width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="mt-2 font-semibold">Modern</div>
                                                        </div>
                                                        <div class="text-center" id="layout-stackedSide">
                                                            <div
                                                                class="flex items-center border rounded-md border-gray-200 dark:border-gray-600 cursor-pointer select-none w-100 hover:ring-1 hover:ring-primary-600 hover:border-primary-600 relative min-h-[80px] w-full">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/stackedSide.jpg') }}"
                                                                    alt="" class="rounded-md dark:hidden">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/stackedSide-dark.jpg') }}"
                                                                    alt=""
                                                                    class="rounded-md hidden dark:block">
                                                            </div>
                                                            <div class="mt-2 font-semibold">Stacked Side</div>
                                                        </div>
                                                        <div class="text-center" id="layout-simple">
                                                            <div
                                                                class="flex items-center border rounded-md border-gray-200 dark:border-gray-600 cursor-pointer select-none w-100 hover:ring-1 hover:ring-primary-600 hover:border-primary-600 relative min-h-[80px] w-full">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/simple.jpg') }}"
                                                                    alt="" class="rounded-md dark:hidden">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/simple-dark.jpg') }}"
                                                                    alt=""
                                                                    class="rounded-md hidden dark:block">
                                                            </div>
                                                            <div class="mt-2 font-semibold">Simple</div>
                                                        </div>
                                                        <div class="text-center" id="layout-decked">
                                                            <div
                                                                class="flex items-center border rounded-md border-gray-200 dark:border-gray-600 cursor-pointer select-none w-100 hover:ring-1 hover:ring-primary-600 hover:border-primary-600 relative min-h-[80px] w-full">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/decked.jpg') }}"
                                                                    alt="" class="rounded-md dark:hidden">
                                                                <img src="{{ asset('assets/img/thumbs/layouts/decked-dark.jpg') }}"
                                                                    alt=""
                                                                    class="rounded-md hidden dark:block">
                                                            </div>
                                                            <div class="mt-2 font-semibold">Decked</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="dialog-search" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog dialog">
                            <div class="dialog-content p-0">
                                <div>
                                    <div
                                        class="px-4 flex items-center justify-between border-b border-gray-200 dark:border-gray-600">
                                        <div class="flex items-center">
                                            <svg stroke="currentColor" fill="none" stroke-width="2"
                                                viewBox="0 0 24 24" aria-hidden="true" class="text-xl"
                                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                            <input
                                                class="ring-0 outline-none block w-full p-4 text-base bg-transparent text-gray-900 dark:text-gray-100"
                                                placeholder="Search...">
                                        </div>
                                        <button
                                            class="button bg-white border border-gray-300 dark:bg-gray-700 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 active:bg-gray-100 dark:active:bg-gray-500 dark:active:border-gray-500 text-gray-600 dark:text-gray-100 rounded font-semibold h-7 px-3 py-1 text-xs"
                                            data-bs-dismiss="modal">Esc</button>
                                    </div>
                                    <div class="py-6 px-5 max-h-[550px] overflow-y-auto">
                                        <div class="mb-6">
                                            <h6 class="mb-3">Recommended</h6>
                                            <a href="https://static.themenate.net/docs/documentation/introduction">
                                                <div
                                                    class="flex items-center justify-between rounded-lg p-3.5 cursor-pointer user-select bg-gray-50 dark:bg-gray-700/60 hover:bg-gray-100 dark:hover:bg-gray-700/90 mb-3">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="mr-4 rounded-md ring-1 ring-slate-900/5 shadow-sm text-xl group-hover:shadow h-6 w-6 flex items-center justify-center bg-white dark:bg-gray-700 text-primary-600 dark:text-gray-100">
                                                            <svg stroke="currentColor" fill="none"
                                                                stroke-width="2" viewBox="0 0 24 24"
                                                                aria-hidden="true" height="1em" width="1em"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-gray-900 dark:text-gray-300">
                                                            <span>
                                                                <span>Documentation</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                        viewBox="0 0 20 20" aria-hidden="true" class="text-lg"
                                                        height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                            <a href="https://static.themenate.net/docs/changelog">
                                                <div
                                                    class="flex items-center justify-between rounded-lg p-3.5 cursor-pointer user-select bg-gray-50 dark:bg-gray-700/60 hover:bg-gray-100 dark:hover:bg-gray-700/90 mb-3">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="mr-4 rounded-md ring-1 ring-slate-900/5 shadow-sm text-xl group-hover:shadow h-6 w-6 flex items-center justify-center bg-white dark:bg-gray-700 text-primary-600 dark:text-gray-100">
                                                            <svg stroke="currentColor" fill="none"
                                                                stroke-width="2" viewBox="0 0 24 24"
                                                                aria-hidden="true" height="1em" width="1em"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-gray-900 dark:text-gray-300">
                                                            <span>
                                                                <span>Changelog</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                        viewBox="0 0 20 20" aria-hidden="true" class="text-lg"
                                                        height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                            <a href="https://static.themenate.net/ui-components/button">
                                                <div
                                                    class="flex items-center justify-between rounded-lg p-3.5 cursor-pointer user-select bg-gray-50 dark:bg-gray-700/60 hover:bg-gray-100 dark:hover:bg-gray-700/90 mb-3">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="mr-4 rounded-md ring-1 ring-slate-900/5 shadow-sm text-xl group-hover:shadow h-6 w-6 flex items-center justify-center bg-white dark:bg-gray-700 text-primary-600 dark:text-gray-100">
                                                            <svg stroke="currentColor" fill="none"
                                                                stroke-width="2" viewBox="0 0 24 24"
                                                                aria-hidden="true" height="1em" width="1em"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-gray-900 dark:text-gray-300">
                                                            <span>
                                                                <span>Button</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                        viewBox="0 0 20 20" aria-hidden="true" class="text-lg"
                                                        height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @include('layout.mobile-nav.mobile_nav')
                    <!-- Popup end -->
                    <div class="h-full flex flex-auto flex-col justify-between">
                        <!-- Content start -->
                        <main class="h-full">
                            @yield('content')
                        </main>
                        <!-- Content end -->
                        <!-- Footer start -->
                        @include('layout.footer.footer')
                        <!-- Footer end -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <!-- Other Vendors JS -->
    <script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/dataTables.custom-ui.min.js') }}"></script>

    <!-- Page js -->
    <script src="{{ asset('assets/js/pages/customers.js') }}"></script>

    <!-- Core JS -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.all.min.js"
        integrity="sha512-xY6WH58rPXt0+5LumlzGmgubLDO+SnuAqjBRO6i1B0VTFFSZR/aXszP6xjdT431rS24D8ztDPVjVPHb3Se9f6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custome Scripts -->
    <script src="{{ asset('assets/js/custom-script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('custom-scripts')
</body>

</html>
