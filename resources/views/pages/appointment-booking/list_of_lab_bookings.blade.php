@extends('layout.main')
@section('title', 'List of Lab Test Bookings')
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-1.5 items-end mb-2">
                                    <h3 class="font-bold leading-none">{{ count($groupedInvoices) }}</h3>
                                    <p class="font-semibold">Offline Lab Appointments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="card card-layout-frame">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <h4>Latest Lab Test Bookings</h4>
                        </div>
                        @foreach($groupedInvoices as $invoice)
                            <div class="mb-6 border rounded-lg shadow-sm p-4 bg-white">
                                <h2 class="text-lg font-semibold mb-2 text-indigo-800">#INV-{{ $invoice['razorpay_order_id'] }}</h2>
                                <div class="flex justify-between">
                                    <div class="mb-3">
                                        <strong>Patient Name:</strong> {{ $invoice['patient_info']['name'] }}<br>
                                        <strong>Email:</strong> {{ $invoice['patient_info']['email'] }}<br>
                                        <strong>Phone:</strong> {{ $invoice['patient_info']['phone'] }}
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('common.session_message')
@endsection
@section('custom-scripts')
    <script>
        $('#offlineAppointmentsDataTable').DataTable();
    </script>
@endsection
