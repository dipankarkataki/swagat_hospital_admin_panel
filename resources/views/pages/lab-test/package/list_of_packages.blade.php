@extends('layout.main')
@section('title', 'List of Lab Test Packages')
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
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"></path>
                                    </svg>
                                </span>
                            </span>
                            <div>
                                <div class="flex gap-1.5 items-end mb-2">
                                    <h3 class="font-bold leading-none">{{ count($all_lab_test_packages) }}</h3>
                                    <p class="font-semibold">Lab Test Packages</p>
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
                            <table id="labTestPackageDataTable" class="table-default table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Included Tests</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Sale Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_lab_test_packages as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="flex items-center">
                                                    <span class="avatar avatar-circle w-[50px]" data-avatar-size="50">
                                                        @if ($item->icon != null)
                                                            <img class="avatar-img avatar-circle" src="{{ asset('storage/' . $item->icon) }}" loading="lazy">
                                                        @else
                                                            <img class="avatar-img avatar-circle" src="{{ asset('assets/img/img-placeholder.png') }}" loading="lazy">
                                                        @endif
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold">{{ $item->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ \Str::limit($item->description, 50) ?? 'N/A' }}</td>
                                            <td>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach($item->categories as $category)
                                                        <span class="px-2 py-1 rounded-full text-white text-xs font-semibold {{ $loop->index % 2 == 0 ? 'bg-indigo-500' : 'bg-emerald-500' }}">
                                                            {{ \Str::limit($category->name, 5) ?? 'N/A'}}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>{{ count(json_decode($item->lab_test_id))}}</td>
                                            <td>{{ $item->full_price}}</td>
                                            <td>{{ $item->discount == '' ? 'N/A' : $item->discount.'%'}}</td>
                                            <td>{{ $item->discounted_price ?? 'N/A'}}</td>
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
                                                <div class="flex justify-end text-lg gap-2">
                                                    <a href="{{ route('lab.package.test.get.by.id', ['id' => encrypt($item->id)]) }}">
                                                        <span class="cursor-pointer p-2 hover:text-indigo-600 editButton">
                                                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('lab.package.test.delete', ['id' => encrypt($item->id)]) }}" class="deleteButton">
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
        $('#labTestPackageDataTable').DataTable();
    </script>
@endsection
