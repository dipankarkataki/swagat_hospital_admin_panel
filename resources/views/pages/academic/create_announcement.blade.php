@extends('layout.main')
@section('title', "Create Academic Announcement")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Create Academic Announcement</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="createAnnouncementForm">
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Announcement Title *</label>
                                <div>
                                    <input type="text" class="input form-control" name="title" id="title" placeholder="e.g B.Sc Program for Girls">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Type *</label>
                                <div>
                                    <select class="input" name="type">
                                        <option value="">Choose</option>
                                        <option value="ongoing">Ongoing</option>
                                        <option value="upcoming">Upcoming</option>
                                        <option value="expired">Expired</option>
                                    </select>
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Start Date</label>
                                <div>
                                    <input type="date" class="input form-control" name="start_date" id="start_date">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">End Date</label>
                                <div>
                                    <input type="date" class="input form-control" name="end_date" id="end_date">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Description</label>
                                <div>
                                    <textarea name="description" class="input input-textarea" placeholder="Type description here ..."></textarea>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {

            $('#createAnnouncementForm').on('submit', function(e){
                e.preventDefault();

                $('#submitAnnouncementBtn').attr('disabled', true);

                $('#submitAnnouncementBtn').html('Creating...');

                const formData = new FormData(this);

                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('academic.announcements.create') }}",
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
