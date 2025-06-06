@extends('layout.main')
@section('title', 'List of Events')
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
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-1.5 items-end mb-2">
                                    <h3 class="font-bold leading-none">{{ count($all_events) }}</h3>
                                    <p class="font-semibold">All Events</p>
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
                            <table id="allEventsTable" class="table-default table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Event Date</th>
                                        <th>Media Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_events as $index => $event)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold">{{ $event->title }}</span>
                                                </div>
                                            </td>
                                            <td>{{ \Str::limit($event->description, 100) ?? 'N/A' }}</td>
                                            <td>{{$event->event_date ?? 'Not Set'}}</td>
                                            <td>{{ $event->media_type }}</td>
                                            <td>
                                                @if ($event->status == 1)
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
                                                <div class="flex justify-end text-lg gap-2">
                                                    <a href="{{ route('recent.events.get.by.id', ['id' => encrypt($event->id)]) }}">
                                                        <span class="flex gap-1 items-center cursor-pointer text-sm font-semibold hover:text-indigo-600 editButton" data-bs-toggle="tooltip" data-bs-title="Edit Event">
                                                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                            </svg>
                                                            Edit
                                                        </span>
                                                    </a>
                                                    {{-- <a href="{{ route('recent.events.get.by.id', ['id' => encrypt($event->id)]) }}" class="deleteButton">
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
    @include('common.session_message')
@endsection
@section('custom-scripts')
    <script>
        $('#allEventsTable').DataTable();
    </script>
@endsection
