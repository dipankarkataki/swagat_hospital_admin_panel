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
                            <div class="form-item">
                                <label class="form-label mb-2">Add Picture</label>
                                <div class="upload upload-draggable hover:border-primary-600 cursor-pointer max-h-[500px]">
                                    <div>
                                        <input class="upload-input draggable" id="academic_images" name="academic_images[]" accept="image/jpeg,image/png" type="file" multiple>
                                    </div>
                                    <div class="text-center">

                                        <div id="previewContainer" class="flex flex-wrap justify-center items-center gap-4 my-4">
                                            @if ($announcement_details->academic_media->isEmpty())
                                                <svg id="uploadImgSvg" class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="200">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                            @else
                                                @foreach ($announcement_details->academic_media as $media)
                                                    <div class="relative w-[150px] h-[150px] media-image-wrapper">
                                                        <!-- Image container -->
                                                        <div class="w-full h-full border rounded overflow-hidden group">
                                                            <img src="{{ asset('storage/' . $media->photo) }}" class="object-cover w-full h-full" alt="Media image" />
                                                        </div>
                                                        <!-- Button container -->
                                                        <div class="absolute top-2 right-2 z-20">
                                                            <button type="button" class="remove-btn bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600 focus:outline-none remove-image-btn" data-id={{$media->id}}>
                                                                X
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
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

            let total_image_count = @json($announcement_details->academic_media).length;
            console.log('Total Image Count ', total_image_count);

            let selectedImages = [];
            function updateUploadSvgVisibility() {
                if (total_image_count > 0) {
                    $('#uploadImgSvg').hide();
                } else {
                    $('#uploadImgSvg').show();
                }
            }

            $('#academic_images').on('change', function (e) {
                const files = Array.from(e.target.files);
                if(total_image_count + files.length > 4){
                    toastr.error('Oops! Maximum 4 images can be uploaded at a time');
                    return;
                }

                if(files.length === 0){
                    return;
                }

                const MAX_IMAGE_SIZE = 1024 * 1024; // 1MB
                const previewContainer = $('#previewContainer');

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

                    const isDuplicate = selectedImages.some(existingFile => (
                        existingFile.name === file.name && existingFile.size === file.size
                    ));

                    if (isDuplicate) {
                        toastr.error(`"${file.name}" has already been added.`);
                        return;
                    }

                    selectedImages.push(file);
                    const selectedImageIndex = selectedImages.length - 1;

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const previewHTML = `
                            <div class="relative w-[150px] h-[150px] new-media-image-wrapper">
                                <div class="w-full h-full border rounded overflow-hidden group">
                                    <img src="${event.target.result}" class="object-cover w-full h-full" alt="Media image" />
                                </div>
                                <div class="absolute top-2 right-2 z-20">
                                    <button type="button" class="remove-btn bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600 focus:outline-none new-remove-image-btn" data-index=${selectedImageIndex}>
                                        X
                                    </button>
                                </div>
                            </div>
                        `;
                        previewContainer.append(previewHTML);
                        total_image_count = total_image_count + 1;
                        updateUploadSvgVisibility();
                        console.log('New Total Image Count after add ', total_image_count);
                        console.log('Selected Images After Adding ---', selectedImages);
                    };
                    reader.readAsDataURL(file);
                });
            });


            //Remove Existing Images

            let removedExistingImages = [];
            $(document).on('click', '.remove-image-btn', function(){
                const image_id = $(this).data('id');
                if(image_id !== undefined){
                    removedExistingImages.push(image_id);
                    console.log('Removed Images Array ------', removedExistingImages);
                }

                total_image_count = total_image_count - 1;
                console.log('New Total Image Count after Remove ', total_image_count);
                $(this).closest('.media-image-wrapper').remove();
                updateUploadSvgVisibility();
                console.log('Selected Images After Removal ---', selectedImages);
            });

            //Remove Newly Added Images

            $(document).on('click', '.new-remove-image-btn', function(){
                const image_index = $(this).data('index');

                if(image_index !== undefined){
                    console.log('Removed image_index', image_index);
                    selectedImages.splice(image_index, 1);
                    $(this).closest('.new-media-image-wrapper').remove();

                    //Re-index remaining buttons to keep array in sync
                    $('.new-media-image-wrapper').each(function (newIndex) {
                        $(this).find('.new-remove-image-btn').attr('data-index', newIndex);
                    });
                }

                total_image_count = total_image_count - 1;
                updateUploadSvgVisibility();
                console.log('Final Selected Images ---', selectedImages);
                console.log('New Total Image Count after Remove ', total_image_count);
            });

            $('#editAnnouncementForm').on('submit', function(e){
                e.preventDefault();

                $('#submitAnnouncementBtn').attr('disabled', true);

                $('#submitAnnouncementBtn').html('Creating...');

                const formData = new FormData(this);
                removedExistingImages.forEach(id => {
                    formData.append('removedExistingImages[]', id);
                });

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
                        console.log('Response ', response);
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
