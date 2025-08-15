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
                    {{-- <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <h4>Latest Lab Test Bookings</h4>
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
                    </div> --}}
                    <div class="card-body">
                        <div class="overflow-x-auto">
                            <table id="labBookingsDataTable" class="table-default table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Invoice No.</th>
                                        <th>Patient Name</th>
                                        <th>Patient Email</th>
                                        <th>Patient Phone</th>
                                        <th>Payment Method</th>
                                        <th>Total Amount</th>
                                        <th>Payment Status</th>
                                        <th>Download Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedInvoices as $index => $invoice)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold">#INV-{{ $invoice['razorpay_order_id'] }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $invoice['patient_info']['name'] }}</td>
                                            <td>{{ $invoice['patient_info']['email'] }}</td>
                                            <td>{{ $invoice['patient_info']['phone'] }}</td>
                                            <td>{{$invoice['patient_info']['payment_method']}}</td>
                                            <td>₹{{$invoice['total_amount']}}</td>
                                            <td>
                                                @if ($invoice['payment_status'] == 'success')
                                                    <div class="flex justify-center items-center">
                                                        <span class="badge-dot bg-emerald-500"></span>
                                                        <span class="ml-2 rtl:mr-2 capitalize">Success</span>
                                                    </div>
                                                @else
                                                    <div class="flex justify-center items-center">
                                                        <span class="badge-dot bg-red-500"></span>
                                                        <span class="ml-2 rtl:mr-2 capitalize">Failed</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex justify-center text-lg gap-2">
                                                    <a href="{{asset('storage/invoice/labTest/pdf/invoice_' . $invoice['razorpay_order_id'] . '.pdf')}}" target="_blank">
                                                        <span class="cursor-pointer p-2 hover:text-indigo-600 editButton">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 20 20">
                                                                <path fill="currentColor" d="M17.924 7.154h-.514l.027-1.89a.464.464 0 0 0-.12-.298L12.901.134A.393.393 0 0 0 12.618 0h-9.24a.8.8 0 0 0-.787.784v6.37h-.515c-.285 0-.56.118-.76.328A1.14 1.14 0 0 0 1 8.275v5.83c0 .618.482 1.12 1.076 1.12h.515v3.99A.8.8 0 0 0 3.38 20h13.278c.415 0 .78-.352.78-.784v-3.99h.487c.594 0 1.076-.503 1.076-1.122v-5.83c0-.296-.113-.582-.315-.792a1.054 1.054 0 0 0-.76-.328ZM3.95 1.378h6.956v4.577a.4.4 0 0 0 .11.277a.37.37 0 0 0 .267.115h4.759v.807H3.95V1.378Zm0 17.244v-3.397h12.092v3.397H3.95ZM12.291 1.52l.385.434l2.58 2.853l.143.173h-2.637c-.2 0-.325-.033-.378-.1c-.053-.065-.084-.17-.093-.313V1.52ZM3 14.232v-6h1.918c.726 0 1.2.03 1.42.09c.34.09.624.286.853.588c.228.301.343.69.343 1.168c0 .368-.066.678-.198.93c-.132.25-.3.447-.503.59a1.72 1.72 0 0 1-.62.285c-.285.057-.698.086-1.239.086h-.779v2.263H3Zm1.195-4.985v1.703h.654c.471 0 .786-.032.945-.094a.786.786 0 0 0 .508-.762a.781.781 0 0 0-.19-.54a.823.823 0 0 0-.48-.266c-.142-.027-.429-.04-.86-.04h-.577Zm4.04-1.015h2.184c.493 0 .868.038 1.127.115c.347.103.644.288.892.552c.247.265.436.589.565.972c.13.384.194.856.194 1.418c0 .494-.06.92-.182 1.277c-.148.437-.36.79-.634 1.06c-.207.205-.487.365-.84.48c-.263.084-.616.126-1.057.126H8.235v-6ZM9.43 9.247v3.974h.892c.334 0 .575-.019.723-.057c.194-.05.355-.132.482-.25c.128-.117.233-.31.313-.579c.081-.269.121-.635.121-1.099c0-.464-.04-.82-.12-1.068a1.377 1.377 0 0 0-.34-.581a1.132 1.132 0 0 0-.553-.283c-.167-.038-.494-.057-.98-.057H9.43Zm4.513 4.985v-6H18v1.015h-2.862v1.42h2.47v1.015h-2.47v2.55h-1.195Z"/>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('common.session_message')
@endsection
@section('custom-scripts')
    <script>
        $('#labBookingsDataTable').DataTable();
    </script>
@endsection
