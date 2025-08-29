@extends('layout.main')
@section('title', "Create Lab Test Category")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Create Test Category</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="createCategoryForm">
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Category Name *
                                    <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Please donot enter the word 'Test' after the category name. For e.g correct Name -> Liver. Incorrect Name -> Liver Test">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                        </svg>
                                    </span>
                                </label>
                                <div>
                                    <input type="text" class="input form-control" name="category_name" id="category_name" placeholder="e.g Full Body Checkup">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Category Icon</label>
                                <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                    <div>
                                        <input class="upload-input draggable" id="uploadCategoryIcon" name="uploadCategoryIcon" type="file">
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
                                        <p class="mt-1 opacity-60 dark:text-white">Support: jpeg, png, webp, svg</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="submitCategoryBtn">Submit</button>
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

            // Preview Picture Before Upload
            $('#uploadCategoryIcon').on('change', function (e) {
                const file = this.files[0];
                if (!file) return;

                const allowedTypes = ['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'];
                const MAX_IMAGE_SIZE = 1024 * 1024; // 1MB

                if (!allowedTypes.includes(file.type)) {
                    toastr.error('Oops! Not a valid image format (allowed: PNG, JPG, JPEG, WEBP, SVG)');
                    this.value = ''; // reset input
                    return;
                }

                if (file.size > MAX_IMAGE_SIZE) {
                    toastr.error('Image size should not exceed 1MB.');
                    this.value = ''; // reset input
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (event) {
                    $('#uploadImgSvg').hide();

                   if (file.type === 'image/svg+xml') {
                        $('#svgPreview').hide();
                        $('#imagePreview').attr('src', event.target.result).show();
                    } else {
                        $('#svgPreview').hide();
                        $('#imagePreview').attr('src', event.target.result).show();
                    }
                };
                reader.readAsDataURL(file);
            });

            $('#createCategoryForm').on('submit', function(e){
                e.preventDefault();

                const formData = new FormData(this);
                const file = $('#uploadCategoryIcon')[0].files[0];
                if (file) {
                    formData.append('uploadCategoryIcon', file);
                }

                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('lab.test.category.create') }}",
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
                        $('#submitCategoryBtn').prop('disabled', false);
                        $('#submitCategoryBtn').text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
