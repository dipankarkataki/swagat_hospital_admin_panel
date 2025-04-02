@extends('layout.main')
@section('title', "List of Doctors'")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>List of Doctor's</h3>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">
                <div class="card card-border">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <span class="avatar avatar-rounded !bg-indigo-600 text-2xl" data-avatar-size="55">
                                    <span class="avatar-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" height="1em" width="1em">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>                                          
                                    </span>
                                </span>
                                <div>
                                    <span>Total Doctors'</span>
                                    <h3>
                                        <span>2,420</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-border">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <span class="avatar avatar-rounded !bg-emerald-500 text-2xl" data-avatar-size="55">
                                    <span class="avatar-icon">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg> 
                                    </span>
                                </span>
                                <div>
                                    <span>Linked Departments</span>
                                    <h3>
                                        <span>1,897</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card adaptable-card">
                <div class="card-body">
                    <table id="customers-data-table" class="table-default table-hover data-table">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Hospital</th>
                                <th>Accepting Appointments</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                            @foreach ($portfolio as $index => $item)
                                <tr>
                                    <td>
                                        {{ $index + 1 }}
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="avatar avatar-circle w-[50px]" data-avatar-size="50">
                                                <img class="avatar-img avatar-circle" src="{{ asset('storage/' . $item->profile_pic) }}" loading="lazy">
                                            </span>
                                            <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold"href="#?id=1">{{ $item->full_name }}</a>
                                        </div>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <div class="flex items-center">{{ $item->department }}</div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">{{ $item->hospital }}</div>
                                    </td>
                                    <td>
                                        <div class="flex justify-center items-center">
                                            @if ($item->accepting_appointments == 1)
                                                <span class="capitalize font-semibold text-emerald-500">Yes</span>
                                            @else
                                                <span class="capitalize font-semibold text-red-500">No</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <div class="flex justify-center items-center">
                                                <span class="badge-dot bg-emerald-500"></span>
                                                <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                            </div>
                                        @else
                                            <div class="flex justify-center items-center">
                                                <span class="badge-dot bg-red-500"></span>
                                                <span class="ml-2 rtl:mr-2 capitalize">Blocked</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex justify-end text-lg">
                                            <span class="cursor-pointer p-2 hover:text-indigo-600" id="editButton" data-url="{{ route('portfolio.create') }}">
                                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </span>
                                            <span class="cursor-pointer p-2 hover:text-red-500" id="deleteButton" data-url="{{ route('portfolio.list') }}">
                                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function(){
            $('#editButton').on('click', function(){
                const url = $(this).data('url');
                alert(url)
            })

            $('#deleteButton').on('click', function(){
                const url = $(this).data('url');
                alert(url)
            })
        });
    </script>
@endsection
