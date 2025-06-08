@extends('layout.main')
@section('title', 'List of Lab Test Categories')
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
                                    <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="1.5"
                                        viewBox="0 0 24 24" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"></path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-1.5 items-end mb-2">
                                    <h3 class="font-bold leading-none">{{ count($list_of_categories) }}</h3>
                                    <p class="font-semibold">Lab Test Categories</p>
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
                            <table id="labTestCategoryTable" class="table-default table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_of_categories as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold">{{ $item->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <div class="flex items-center">
                                                        <span class="badge-dot bg-emerald-500"></span>
                                                        <span class="ml-2 rtl:mr-2 capitalize">active</span>
                                                    </div>
                                                @else
                                                    <div class="flex items-center">
                                                        <span class="badge-dot bg-red-500"></span>
                                                        <span class="ml-2 rtl:mr-2 capitalize">Blocked</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex text-lg gap-2">
                                                    <a href="{{ route('lab.test.category.get.by.id', ['id' => encrypt($item->id)]) }}">
                                                        <span class="cursor-pointer p-2 hover:text-indigo-600 editButton">
                                                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('lab.test.category.delete', ['id' => encrypt($item->id)]) }}" class="deleteButton">
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
        $('#labTestCategoryTable').DataTable();
    </script>
@endsection
