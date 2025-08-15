@extends('layout.main')
@section('title', "Edit Hospital")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-4">
                    <a href="{{route('hospital.list')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"></path>
                        </svg>
                    </a>
                    <h3>Edit Hospital</h3>
                </div>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="editHospitalForm">
                        <div class="form-container">
                            <input type="hidden" class="input" name="hospital_id" id="hospital_id" value="{{ $hospital->id }}" readonly>
                            <div class="form-item">
                                <label class="form-label mb-2">Hospital Picture *</label>
                                <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]" @error('hospital_image') style="border: 2px dashed rgb(239 68 68)" @enderror>
                                    <div>
                                        <input class="upload-input draggable" id="hospital_image" name="hospital_image" type="file">
                                    </div>
                                    <div class="text-center">

                                        @if ($hospital->image != null)
                                            <div class="flex flex-row justify-center items-center">
                                                <img id="imageFromDB" src="{{ asset('storage/'.$hospital->image) }}" alt="Image Preview" style="max-width: 350px; max-height:200px; margin-top: 10px; margin-bottom:10px; border-radius: 5px;">
                                            </div>
                                        @else
                                            <svg id="uploadImgSvg" class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        @endif
                                        <div class="flex flex-row justify-center items-center">
                                            <img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-width: 350px; max-height:200px; margin-top: 10px; margin-bottom:10px; border-radius: 5px;">
                                        </div>
                                        <p class="font-semibold">
                                            <span class="text-gray-800 dark:text-white">Drop your image here, or</span>
                                            <span class="text-blue-500">browse</span>
                                        </p>
                                        <p class="mt-1 opacity-60 dark:text-white">Support: jpeg, png, webp</p>
                                    </div>
                                </div>
                                @error('hospital_image')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Hospital Name *</label>
                                <div>
                                    <input type="text" class="input" name="hospital_name" id="hospital_name" placeholder="e.g New ward hospital" value="{{ $hospital->name }}">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Hospital Phone *</label>
                                <div>
                                    <input type="text" class="input" name="hospital_phone" id="hospital_phone" placeholder="e.g 7896023141" value="{{ $hospital->phone }}">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Hospital Address *</label>
                                <div>
                                    <input type="text" class="input" name="hospital_address" id="hospital_address" placeholder="e.g 123, street, gwalior" value="{{ $hospital->address }}">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="editHospitalBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="grid border border-gray-950 border-dashed rounded-md p-8">
                        <div>
                            <label class="form-label mb-2">Change Account Status:</label>
                            @if ($hospital->status == 1)
                                <button class="btn bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600 text-white update-account-status" type="button" data-url="{{ route('hospital.status.update') }}" data-id="{{ encrypt($hospital->id) }}" data-status=0> Account Active </button>
                            @else
                                <button class="btn btn-md bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white update-account-status" type="button" data-url="{{ route('hospital.status.update') }}" data-id="{{ encrypt($hospital->id) }}" data-status=1> Account Blocked</button>
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


            // Preview Event Picture Before Upload
            $('#hospital_image').on('change', function(e) {

                const file = this.files[0];
                const file_type = file.type.split('/')[0];
                const MAX_IMAGE_SIZE = 1024 * 1024;

                if(file && file_type == 'image'){

                    if (file.size > MAX_IMAGE_SIZE) {
                        toastr.error('Image size should not exceed 1MB.');
                        $('#submitHospitalBtn').prop('disabled', false).text('Submit');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#uploadImgSvg').hide();
                        $('#imageFromDB').hide();
                        $('#imagePreview').attr('src', event.target.result).show();
                    };
                    reader.readAsDataURL(file);
                }else{
                    toastr.error('Oops! Not a valid image format');
                }
            });

            $('#editHospitalForm').on('submit', function(e){
                e.preventDefault();

                const MAX_IMAGE_SIZE = 1024 * 1024;
                const hospital_image = $('#hospital_image')[0].files[0];

                if (hospital_image && hospital_image.size > MAX_IMAGE_SIZE) {
                    toastr.error('Image size should not exceed 1MB.');
                    $('#submitHospitalBtn').prop('disabled', false).text('Submit');
                    return;
                }

                const formData = new FormData(this);

                if(hospital_image){
                    formData.append('hospital_image', hospital_image);
                }


                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('hospital.edit') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        console.log('Response ==> ', response)
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
                        $('#editHospitalBtn').prop('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
