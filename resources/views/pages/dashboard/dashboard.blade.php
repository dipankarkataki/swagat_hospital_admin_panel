@extends('layout.main')
@section('title', 'Dashboard')
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="flex flex-col gap-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="card card-layout-frame">
                    <div class="card-body">
                        <div class="flex items-center gap-4">
                            <span
                                class="avatar avatar-rounded bg-indigo-100 text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-100 avatar-lg text-3xl"
                                data-avatar-size="55">
                                <span class="avatar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" height="1em" width="1em">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-1.5 items-end mb-2">
                                    <h3 class="font-bold leading-none">{{ $total_portfolio }}</h3>
                                    <p class="font-semibold">Doctors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-layout-frame">
                    <div class="card-body">
                        <div class="flex items-center gap-4">
                            <span
                                class="avatar avatar-rounded bg-cyan-100 text-cyan-600 dark:bg-cyan-500/20 dark:text-cyan-100 avatar-lg text-3xl"
                                data-avatar-size="55">
                                <span class="avatar-icon">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                        aria-hidden="true" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-2 items-center mb-2">
                                    <h3 class="font-bold leading-none">{{$total_appointments}}</h3>
                                    <div class="flex flex-col">
                                        <p class="font-semibold">Offline</p>
                                        <p class="font-semibold">Appointments</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-layout-frame">
                    <div class="card-body">
                        <div class="flex items-center gap-4">
                            <span
                                class="avatar avatar-rounded bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-100 avatar-lg text-3xl"
                                data-avatar-size="55">
                                <span class="avatar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" height="1em" width="1em">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-1.5 items-end mb-2">
                                    <h3 class="font-bold leading-none">0</h3>
                                    <p class="font-semibold">Consultations</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-layout-frame">
                    <div class="card-body">
                        <div class="flex items-center gap-4">
                            <span
                                class="avatar avatar-rounded bg-amber-100 text-amber-600 dark:bg-amber-500/20 dark:text-amber-100 avatar-lg text-3xl"
                                data-avatar-size="55">
                                <span class="avatar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" height="1em" width="1em">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"></path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-1.5 items-end mb-2">
                                    <h3 class="font-bold leading-none">{{$total_lab_tests}}</h3>
                                    <p class="font-semibold">Lab Tests</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-layout-frame">
                    <div class="card-body">
                        <div class="flex items-center gap-4">
                            <span
                                class="avatar avatar-rounded bg-pink-100 text-pink-600 dark:bg-pink-500/20 dark:text-pink-100 avatar-lg text-3xl"
                                data-avatar-size="55">
                                <span class="avatar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" height="1em" width="1em">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-2 items-center mb-2">
                                    <h3 class="font-bold leading-none">{{$total_lab_tests_package}}</h3>
                                    <div class="flex flex-col">
                                        <p class="font-semibold">Lab</p>
                                        <p class="font-semibold">Packages</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-layout-frame xl:col-span-5">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <h4>Latest Offline Appointments</h4>
                        <a href="{{route('appointment.offline.list')}}" class="btn btn-default btn-sm">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table-default table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Email</th>
                                    <th>Created Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latest_offline_appointments as $item)
                                    <tr>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                <span class="avatar avatar-circle avatar-sm" data-avatar-size="25">
                                                    <img class="avatar-img avatar-circle" src="{{asset('assets/img/avatars/thumb-1.jpg')}}"
                                                        loading="lazy">
                                                </span>
                                                <span class="font-semibold">{{$item->full_name}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tag rounded-md">New</div>
                                        </td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            <span>
                                                {{$item->appointment_date}} {{$item->appointment_time}}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No Latest Appointments.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 xl:grid-cols-7 gap-4">
                <div class="card card-layout-frame xl:col-span-5">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <h4>Latest Lab Test Bookings</h4>
                            <a href="{{route('appointment.lab.test.bookings')}}" class="btn btn-default btn-sm">View All</a>
                        </div>
                        @forelse($groupedInvoices as $invoice)
                            <div class="mb-6 border rounded-lg shadow-sm p-4 bg-white">
                                <h2 class="text-lg font-semibold mb-2 text-indigo-800">#INV-{{ $invoice['razorpay_order_id'] }}</h2>
                                <div class="flex justify-between">
                                    <div class="mb-3">
                                        <strong>Patient Name:</strong> {{ $invoice['patient_info']['name'] }}<br>
                                        <strong>Email:</strong> {{ $invoice['patient_info']['email'] }}<br>
                                        <strong>Phone:</strong> {{ $invoice['patient_info']['phone'] }}<br>
                                        <strong>Payment Method:</strong> <span style="text-transform: capitalize;">{{$invoice['patient_info']['payment_method']}}</span>
                                    </div>
                                    <img src="{{ asset('assets/img/others/paid_stamp.png') }}" alt="paid status" style="height: 60px;" />
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="table-auto w-full border-collapse border border-gray-300 mb-3">
                                        <thead class="bg-[#024568] text-white">
                                            <tr>
                                                <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Unit Price</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($invoice['items'] as $index => $item)
                                                <tr class="hover:bg-gray-100">
                                                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                                    <td class="border border-gray-300 px-4 py-2">{{ $item['description'] }}</td>
                                                    <td class="border border-gray-300 px-4 py-2">{{ $item['quantity'] }}</td>
                                                    <td class="border border-gray-300 px-4 py-2">₹{{ number_format($item['unit_price'], 2) }}</td>
                                                    <td class="border border-gray-300 px-4 py-2">₹{{ number_format($item['total'], 2) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="bg-gray-100 font-semibold">
                                                <td colspan="4" class="border border-gray-300 px-4 py-2 text-right">Subtotal</td>
                                                <td class="border border-gray-300 px-4 py-2">₹{{ number_format($invoice['subtotal'], 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <div class="flex justify-center items-center h-full">
                                <p class="h-full">Empty Bookings!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card card-layout-frame xl:col-span-2">
                    <div class="card-body">
                        <h4>Online Consultations</h4>
                        <div class="mt-6">
                            <div class="progress flex justify-center circle">
                                <div class="progress-circle" style="width: 200px;">
                                    <span class="progress-circle-info">
                                        <span class="progress-info circle">
                                            <div class="text-center">
                                                <h3 class="font-bold">0</h3>
                                                <p class="font-semi">Currently Disabled</p>
                                            </div>
                                        </span>
                                    </span>
                                    <svg viewBox="0 0 100 100">
                                        <path d="M 50,50 m 0,-48 a 48,48 0 1 1 0,96 a 48,48 0 1 1 0,-96" stroke-width="4"
                                            fill-opacity="0" class="progress-circle-trail"
                                            style="stroke-dasharray: 301.593px, 301.593px; stroke-dashoffset: 0px;">
                                        </path>
                                        <path d="M 50,50 m 0,-48 a 48,48 0 1 1 0,96 a 48,48 0 1 1 0,-96"
                                            stroke-linecap="round" stroke-width="4" fill-opacity="0"
                                            class="progress-circle-stroke text-gray-600"
                                            style="stroke-dasharray: 220.163px, 301.593px; stroke-dashoffset: 0px;">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center mt-6">
                                <p class="font-semibold">Monthly</p>
                                <h4 class="font-bold">Average</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
