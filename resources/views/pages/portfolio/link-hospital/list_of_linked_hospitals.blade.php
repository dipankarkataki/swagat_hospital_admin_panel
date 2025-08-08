@extends('layout.main')
@section('title', 'List of Linked Portfolios')
@section('content')
    {{-- @dd($opd_schedules) --}}
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>List of Linked Portfolios</h3>
            </div>
            <div class="flex flex-col gap-4">
                <div class="grid grid-cols-1">
                    <div class="card card-layout-frame">
                        <div class="card-body">
                            <div class="overflow-x-auto">
                                <table id="opdDataTable" class="table-default table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Doctor</th>
                                            <th>Assigned Hospital</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($linked_hospitals as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="flex items-center gap-3">
                                                        <span class="avatar avatar-circle w-[50px]" data-avatar-size="50">
                                                            <img class="avatar-img avatar-circle" src="{{ asset('storage/' . optional($item->portfolio)->profile_pic) }}" loading="lazy">
                                                        </span>
                                                        <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold">{{ optional($item->portfolio)->full_name }}</a>
                                                    </div>
                                                </td>
                                                <td>{{ optional($item->portfolio)->name }}</td>
                                                 <td>{{ optional($item->portfolio)->address }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <div class="flex justify-start items-center">
                                                            <span class="badge-dot bg-emerald-500"></span>
                                                            <span class="ml-2 rtl:mr-2 capitalize">Active</span>
                                                        </div>
                                                    @else
                                                        <div class="flex justify-start items-center">
                                                            <span class="badge-dot bg-red-500"></span>
                                                            <span class="ml-2 rtl:mr-2 capitalize">Inactive</span>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="flex justify-start items-center text-lg gap-2">
                                                        <a href="{{ route('linked.hospital.edit.get', ['id' => encrypt($item->id)]) }}">
                                                            <span class="flex gap-1 items-center cursor-pointer text-sm font-semibold hover:text-indigo-600 editButton" data-bs-toggle="tooltip" data-bs-title="Edit Linked Hospital">
                                                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                                </svg>
                                                                Edit
                                                            </span>
                                                        </a>
                                                        {{-- <a href="{{ route('hospital.delete', ['id' => encrypt($item->id)]) }}" class="deleteButton">
                                                            <span class="cursor-pointer p-2 hover:text-red-500">
                                                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </span>
                                                        </a> --}}
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
    </div>
    @include('common.session_message')
@endsection
@section('custom-scripts')
    <script>
        $('#opdDataTable').DataTable();
    </script>
@endsection
