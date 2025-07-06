@extends('layout.main')
@section('title', "Edit Academic Announcement")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-4">
                    <a href="{{route('academic.announcements.get.list')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"></path>
                        </svg>
                    </a>
                    <h3>Edit Academic Announcement</h3>
                </div>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="editAnnouncementForm">

                        <div class="form-container">
                            <div class="form-item">
                                <div>
                                    <input type="hidden" class="input form-control" name="announcement_id" value="{{encrypt($announcement_details->id)}}">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Announcement Title *</label>
                                <div>
                                    <input type="text" class="input form-control" name="title" id="title" value="{{$announcement_details->name}}" placeholder="e.g B.Sc Program for Girls">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Type *</label>
                                <div>
                                    <select class="input" name="type">
                                        <option value="">Choose</option>
                                        <option value="ongoing" {{$announcement_details->type === 'ongoing' ? 'selected' : null}}>Ongoing</option>
                                        <option value="upcoming" {{$announcement_details->type === 'upcoming' ? 'selected' : null}}>Upcoming</option>
                                        <option value="expired" {{$announcement_details->type === 'expired' ? 'selected' : null}}>Expired</option>
                                    </select>
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Start Date</label>
                                <div>
                                    <input type="date" class="input form-control" name="start_date" id="start_date" value="{{$announcement_details->start_date}}">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">End Date</label>
                                <div>
                                    <input type="date" class="input form-control" name="end_date" id="end_date" value="{{$announcement_details->end_date}}">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Description</label>
                                <div>
                                    <textarea name="description" class="input input-textarea" placeholder="Type description here ...">{{$announcement_details->description}}</textarea>
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="submitAnnouncementBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="grid border border-gray-950 border-dashed rounded-md p-8">
                        <div>
                            <label class="form-label mb-2">Change Status:</label>
                            @if ($announcement_details->status == 1)
                                <button class="btn bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600 text-white update-account-status" type="button" data-url="{{ route('academic.announcement.update.status') }}" data-id="{{ encrypt($announcement_details->id) }}" data-status=0> Announcement Active </button>
                            @else
                                <button class="btn btn-md bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white update-account-status" type="button" data-url="{{ route('academic.announcement.update.status') }}" data-id="{{ encrypt($announcement_details->id) }}" data-status=1> Announcement Blocked</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {

            $('#editAnnouncementForm').on('submit', function(e){
                e.preventDefault();

                $('#submitAnnouncementBtn').attr('disabled', true);

                $('#submitAnnouncementBtn').html('Creating...');

                const formData = new FormData(this);

                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('academic.announcement.edit') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response.success === true){
                            toastr.success(response.message);
                            location.reload();
                        }else{
                            toastr.error(response.message);
                            const errors = response.data;
                            for (const field in errors) {
                                const input = $(`[name="${field}"]`);
                                input.addClass('input-invalid');

                                input.closest('.form-item').find('.error-message').html(
                                    `<div class="text-red-500 mt-2">${errors[field][0]}</div>`
                                );
                            }
                        }
                    }, error:function(xhr){
                        if (xhr) {
                            toastr.error("Oops! Something went wrong. Please try later.");
                        }
                    },complete:function(){
                        $('#submitAnnouncementBtn').prop('disabled', false);
                        $('#submitAnnouncementBtn').text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
