@extends('layout.main')
@section('title', 'List of Appointments')
@section('content')
    {{-- @dd($list_of_appointments) --}}
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
                                    <h3 class="font-bold leading-none">{{ count($list_of_appointments) }}</h3>
                                    <p class="font-semibold">Offline Appointments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="card card-layout-frame">
                    <div class="card-body">
                        <div class="overflow-x-auto">
                            <table id="offlineAppointmentsDataTable" class="table-default table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Booking_Id</th>
                                        <th>Patient_Name</th>
                                        <th>Patient_Gender</th>
                                        <th>Patient_Email</th>
                                        <th>Patient_Phone</th>
                                        <th>Appointment_Date</th>
                                        <th>Appointment_Time</th>
                                        <th>Department</th>
                                        <th>Assigned_Doctor</th>
                                        <th>Hospital</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_of_appointments as $index => $appointment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold">{{ $appointment->booking_id }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $appointment->full_name ?? '-----' }}</td>
                                            <td>{{ $appointment->gender ?? '-----'}}</td>
                                            <td>{{ $appointment->email ?? '-----'}}</td>
                                            <td>{{ $appointment->phone ?? '-----'}}</td>
                                            <td>{{ $appointment->appointment_date ?? '-----'}}</td>
                                            <td>{{ $appointment->appointment_time ?? '-----'}}</td>
                                            <td>{{ optional($appointment->portfolio->departments)->name ?? '-----'}}</td>
                                            <td>{{ optional($appointment->portfolio)->full_name ?? '-----'}} [{{ optional($appointment->portfolio)->email ?? '-----'}}]</td>
                                            <td>{{ optional($appointment->hospital)->name ?? '-----'}}</td>
                                            <td>
                                                @if ($appointment->status == 1)
                                                    <div class="flex justify-center items-center">
                                                        <span class="badge-dot bg-emerald-500"></span>
                                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                                    </div>
                                                @else
                                                    <div class="flex justify-center items-center">
                                                        <span class="badge-dot bg-red-500"></span>
                                                        <span class="ml-2 rtl:mr-2 capitalize">Expired</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex justify-end text-lg gap-2">
                                                    <a href="{{ route('lab.test.get.by.id', ['id' => encrypt($appointment->id)]) }}">
                                                        <span class="cursor-pointer p-2 hover:text-indigo-600 editButton">
                                                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('lab.test.delete', ['id' => encrypt($appointment->id)]) }}" class="deleteButton">
                                                        <span class="cursor-pointer p-2 hover:text-red-500">
                                                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
        $('#offlineAppointmentsDataTable').DataTable();
    </script>
@endsection
