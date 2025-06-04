@extends('layout.main')
@section('title', "Create Event")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Create Event</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="createHospitalForm">
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Select Doctor *</label>
                                <div>
                                    <select class="input" name="portfolio_id" id="portfolio_id">
                                        <option value=""> Choose </option>

                                        @foreach ($portfolio_list as $doctor)
                                            <option value="{{ $doctor->id }}"> {{ $doctor->full_name }} :  [ {{$doctor->email}} ]  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Event Title *</label>
                                <div>
                                    <input class="input" name="event_title" id="event_title" placeholder="e.g Blood donation campaining">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Event Description*</label>
                                <div>
                                    <textarea class="input input-textarea" name="event_title" id="event_title" placeholder="write here..." maxlength="200"></textarea>
                                    <span class="ml-1 text-xs">Maximum allowed characters 200.</span>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Select Media Type *</label>
                                <div>
                                    <select class="input" name="media_type" id="media_type">
                                        <option value=""> Choose </option>
                                        <option value="picture">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-item" id="media_type_picture" style="display:none;">
                                <label class="form-label mb-2">Add Event Picture</label>
                                <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                    <div>
                                        <input class="upload-input draggable" id="eventPicture" name="eventPicture" type="file">
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
                            <div id="media_type_video" style="display:none;">
                                <div class="form-item">
                                    <label class="form-label mb-2">Add Event Video Thumbnail</label>
                                    <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                        <div>
                                            <input class="upload-input draggable" id="eventVideoThumbnail" name="eventVideoThumbnail" type="file">
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
                                <div class="form-item">
                                    <label class="form-label mb-2">Add Event Video</label>
                                    <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                        <div>
                                            <input class="upload-input draggable" id="eventVideo" name="eventVideo" type="file">
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
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="submitHospitalBtn">Submit</button>
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
                console.log('Selected Media', media)
            });
        });
    </script>
@endsection
