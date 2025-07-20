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
                    <form id="createAnnouncementForm" enctype="multipart/form-data">
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Announcement Title *</label>
                                <div>
                                    <input type="text" class="input form-control" name="title" id="title" placeholder="e.g B.Sc Program for Girls" required>
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Type *</label>
                                <div>
                                    <select class="input" name="type" required>
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
                            <div class="form-item">
                                <label class="form-label mb-2">Add Picture</label>
                                <div class="upload upload-draggable hover:border-primary-600 cursor-pointer max-h-[500px]">
                                    <div>
                                        <input class="upload-input draggable" id="academic_images" name="academic_images[]" type="file" multiple>
                                    </div>
                                    <div class="text-center">
                                        <svg id="uploadImgSvg" class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="200">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <div class="">
                                            {{-- <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-width: 150px; margin-top: 10px; margin-bottom:10px; border-radius: 5px;"> --}}
                                            <div id="previewContainer" class="flex flex-wrap justify-center items-center gap-4 my-4"></div>
                                        </div>
                                        <p class="font-semibold">
                                            <span class="text-gray-800 dark:text-white">Drop your image here, or</span>
                                            <span class="text-blue-500">browse</span>
                                        </p>
                                        <p class="text-sm">
                                            <span class="text-gray-800 dark:text-white">Press and hold ctrl or cmd to select multiple image</span>
                                        </p>
                                        <p class="mt-1 mb-5 opacity-60 dark:text-white">Support: jpeg, png</p>
                                    </div>
                                </div>
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

            let selectedImages = [];
            $('#previewContainer').hide();

            $('#academic_images').on('change', function (e) {
                const files = Array.from(e.target.files);
                console.log('Files ---', files);
                console.log('Selected Images ---', selectedImages);
                if(files.length > 4){
                    toastr.error('Oops! Maximum 4 images can be uploaded at a time');
                    return;
                }

                if(files.length === 0){
                    return;
                }

                const MAX_IMAGE_SIZE = 1024 * 1024; // 1MB
                const previewContainer = $('#previewContainer');
                previewContainer.show();
                previewContainer.empty(); // clear previous previews
                selectedImages = []; // reset

                files.forEach((file, index) => {
                    const fileType = file.type.split('/')[0];

                    if (fileType !== 'image') {
                        toastr.error('Invalid format. Only images are allowed.');
                        return;
                    }

                    if (file.size > MAX_IMAGE_SIZE) {
                        toastr.error(`Image "${file.name}" exceeds 1MB.`);
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const previewHTML = `
                            <div class="relative w-[150px] h-[150px] border rounded overflow-hidden group">
                                <img src="${event.target.result}" class="object-cover w-full h-full" />
                            </div>
                        `;
                        previewContainer.append(previewHTML);
                        selectedImages.push(file);
                    };
                    reader.readAsDataURL(file);
                    $('#uploadImgSvg').hide();
                });
            });

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
                        console.log('response announcement ', response);
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
