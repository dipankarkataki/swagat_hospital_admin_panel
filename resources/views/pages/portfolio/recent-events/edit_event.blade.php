@extends('layout.main')
@section('title', "Edit Recent Event")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Edit Event</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="createEventForm" enctype="multipart/form-data" class="skip-global-submit">
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Select Doctor *</label>
                                <div>
                                    <input class="input" type="text" name="portfolio_id" id="portfolio_id" value="{{$event_details->portfolio->full_name}} : [{{$event_details->portfolio->email}}]" required readonly>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Event Title *</label>
                                <div>
                                    <input class="input" type="text" name="event_title" id="event_title" value="{{$event_details->title}}" placeholder="e.g Blood donation campaining" required>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Event Description</label>
                                <div>
                                    <textarea class="input input-textarea" name="event_description" id="event_description" placeholder="write here..." maxlength="200">{{$event_details->description}}</textarea>
                                    <span class="ml-1 text-xs">Maximum allowed characters 200.</span>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Event Date</label>
                                <div>
                                    <input class="input" type="date" name="event_date" id="event_date" value="{{$event_details->event_date}}">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Select Media Type *</label>
                                <div>
                                    <select class="input" name="media_type" id="media_type" required>
                                        <option value=""> Choose </option>
                                        <option value="picture" {{$event_details->media_type == 'picture' ? 'selected' : null}}>Image</option>
                                        <option value="video" {{$event_details->media_type == 'video' ? 'selected' : null}}>Video</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-item" id="media_type_picture" style="{{$event_details->media_type == 'picture' ? 'display:block' : 'display:none'}}">
                                <label class="form-label mb-2">Add Event Picture</label>
                                <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                    <div>
                                        <input class="upload-input draggable" id="eventPicture" name="event_picture" type="file">
                                    </div>
                                    <div class="text-center">
                                        <svg id="uploadImgSvg" class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <div class="flex flex-row justify-center items-center">
                                            <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-width: 150px; margin-top: 10px; margin-bottom:10px; border-radius: 5px;">
                                        </div>
                                        <p class="font-semibold">
                                            <span class="text-gray-800 dark:text-white">Drop your image here, or</span>
                                            <span class="text-blue-500">browse</span>
                                        </p>
                                        <p class="mt-1 opacity-60 dark:text-white">Support: jpeg, png</p>
                                    </div>
                                </div>
                            </div>
                            <div id="media_type_video" style="{{$event_details->media_type == 'video' ? 'display:block' : 'display:none' }}">
                                <div class="form-item">
                                    <label class="form-label mb-2">Add Event Video Thumbnail</label>
                                    <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                        <div>
                                            <input class="upload-input draggable" id="eventVideoThumbnail" name="event_video_thumbnail" type="file">
                                        </div>
                                        <div class="text-center">
                                            <svg id="uploadThumbnailImgSvg" class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                            <div class="flex flex-row justify-center items-center">
                                                <img id="thumbnailImagePreview" src="" alt="Image Preview" style="display:none; max-width: 150px; margin-top: 10px; margin-bottom:10px; border-radius: 5px;">
                                            </div>
                                            <p class="font-semibold">
                                                <span class="text-gray-800 dark:text-white">Drop your image here, or</span>
                                                <span class="text-blue-500">browse</span>
                                            </p>
                                            <p class="mt-1 opacity-60 dark:text-white">Support: jpeg, png</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <label class="form-label mb-2">Add Event Video</label>
                                    <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                        <div>
                                            <input class="upload-input draggable" id="eventVideo" name="event_video" type="file">
                                        </div>
                                        <div class="text-center">
                                            <svg id="uploadVideoSvg" class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"></path>
                                            </svg>
                                            <div class="flex flex-row justify-center items-center">
                                                <video id="videoPreview" src="" alt="Video Preview" style="display:none; max-width: 350px; margin-top: 10px; margin-bottom:10px; border-radius: 5px;" controls></video>
                                            </div>
                                            <p class="font-semibold">
                                                <span class="text-gray-800 dark:text-white">Drop your video here, or</span>
                                                <span class="text-blue-500">browse</span>
                                            </p>
                                            <p class="mt-1 opacity-60 dark:text-white">Support: mp4, avi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress line" id="progressBar" style="display: none;">
                                <div class="progress-wrapper">
                                    <div class="progress-inner">
                                        <div class="progress-bg h-2 bg-primary-600" id="progressBg" style="width: 0%;"></div>
                                    </div>
                                </div>
                                <span class="progress-info line" id="progressBarData">30%</span>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="submitEventBtn">Submit</button>
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
        $(document).ready(function(){
            //Toggle content based on media type
            $('#media_type').on('change', function(e){
                const media = e.target.value;
                if (!media) {
                    toastr.error('Please select a valid option.');
                    $('#media_type_picture, #media_type_video').hide();
                    return;
                }

                if (media === 'picture') {
                    $('#media_type_picture').show();
                    $('#media_type_video').hide();
                } else if (media === 'video') {
                    $('#media_type_picture').hide();
                    $('#media_type_video').show();
                } else {
                    $('#media_type_picture, #media_type_video').hide();
                }
            });

            // Preview Event Picture Before Upload
            $('#eventPicture').on('change', function(e) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#uploadImgSvg').hide();
                    $('#imagePreview').attr('src', event.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            // Preview Event Thumbnail Before Upload
            $('#eventVideoThumbnail').on('change', function(e) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#uploadThumbnailImgSvg').hide();
                    $('#thumbnailImagePreview').attr('src', event.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            //Preview Video before upload
            $('#eventVideo').on('change', function(e) {
                var file = this.files[0];
                if (file) {
                    var videoUrl = URL.createObjectURL(file);
                    $('#uploadVideoSvg').hide();
                    $('#videoPreview')
                        .attr('src', videoUrl)
                        .show();
                }
            });

            //Create Event
            $('#createEventForm').on('submit', function(e){
                e.preventDefault();

                $('#submitEventBtn').prop('disabled', true).text('Please wait...');

                const formData = new FormData(this);

                const media_type = $('#media_type').val();

                const MAX_IMAGE_SIZE = 1024 * 1024; // 1MB in bytes
                const MAX_VIDEO_SIZE = 3024 * 1024; // 3MB in bytes

                if(media_type === 'picture'){
                    const file = $('#eventPicture')[0].files[0];
                    if(file){
                        if (file.size > MAX_IMAGE_SIZE) {
                            toastr.error('Image size should not exceed 1MB.');
                            $('#submitEventBtn').prop('disabled', false).text('Submit');
                            return;
                        }
                        formData.append('event_picture', file);
                    }
                }else{
                    const thumbnail = $('#eventVideoThumbnail')[0].files[0];
                    const video = $('#eventVideo')[0].files[0];
                    if(thumbnail && video){
                        if (thumbnail.size > MAX_IMAGE_SIZE) {
                            toastr.error('Thumbnail image size should not exceed 1MB.');
                            $('#submitEventBtn').prop('disabled', false).text('Submit');
                            return;
                        }

                        if (video.size > MAX_VIDEO_SIZE) {
                            toastr.error('Video size should not exceed 3MB.');
                            $('#submitEventBtn').prop('disabled', false).text('Submit');
                            return;
                        }

                        formData.append('event_video_thumbnail', thumbnail);
                        formData.append('event_video', video);

                    }else{
                        toastr.error('Please add both thumbnail and video');
                        $('#submitEventBtn').prop('disabled', false).text('Submit');
                        return;
                    }
                }

                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{route('recent.events.create')}}",
                    type:"POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                $('#progressBg').css('width', percentComplete + '%');
                                $('#progressBarData').text('Uploading ' + percentComplete + '%');
                                $('#progressBar').show();
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response){
                        if(response.success === true){
                            console.log('Response', response);
                            toastr.success(response.message);
                            $('#createEventForm')[0].reset();
                        }else{
                            toastr.error(response.message);
                        }
                    }, error: function(xhr){
                        if (xhr) {
                            toastr.error("Oops! Something went wrong. Please try later.");
                        }
                    }, complete: function(){
                        setTimeout(() => {
                            $('#progressBar').fadeOut('slow'); // Smooth fade out
                            $('#progressBg').css('width', '0%');
                            $('#progressBarData').text('Upload Complete ✅');
                            $('#submitEventBtn').prop('disabled', false).text('Submit');
                            location.reload();
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection
