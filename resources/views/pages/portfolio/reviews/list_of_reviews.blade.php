@extends('layout.main')
@section('title', "List of Reviews'")
@section('custom-style')
@endsection
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>List of Portfolio Reviews</h3>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">
                <div class="card card-border">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <span class="avatar avatar-rounded !bg-indigo-600 text-2xl" data-avatar-size="55">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-7 h-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                                    </svg>
                                </span>
                                <div>
                                    <span>Total Reviews</span>
                                    <h3>
                                        <span>{{ count($portfolio_reviews) }}</span>
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
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                            @foreach ($portfolio_reviews as $index => $item)
                                <tr>
                                    <td>
                                        {{ $index + 1 }}
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <span class="avatar avatar-circle w-[50px]" data-avatar-size="50">
                                                <img class="avatar-img avatar-circle" src="{{ asset('storage/' . optional($item->docProfile)->profile_pic) }}" loading="lazy">
                                            </span>
                                            <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold">{{ optional($item->docProfile)->full_name }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">{{ optional($item->docProfile)->email }}</div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">{{ $item->review ?? '' }}</div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">{{ $item->rating ?? '' }}</div>
                                    </td>
                                    <td>
                                        <div class="flex justify-end text-lg gap-2">
                                            <a href="{{ route('portfolio.reviews.delete', ['id' => encrypt($item->id)]) }}" class="deleteButton">
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
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('success'))
        <div class="toast-position">
            <div class="toast fade show" id="notificationToastSuccess">
                <div class="notification">
                    <div class="notification-content">
                        <div class="mr-3">
                            <span class="text-2xl text-emerald-400">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="mr-4">
                            <div class="notification-title">Success</div>
                            <div class="notification-description">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('exception'))
        <div class="toast-position">
            <div class="toast fade show" id="notificationToastError">
                <div class="notification">
                    <div class="notification-content">
                        <div class="mr-3">
                            <span class="text-2xl text-red-400">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="mr-4">
                            <div class="notification-title">Error</div>
                            <div class="notification-description">
                                {{ Session::get('exception') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
