@extends('layout.main')
@section('title', "Edit Lab Test Category")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-4">
                    <a href="{{route('lab.test.category.list')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"></path>
                        </svg>
                    </a>
                    <h3>Edit Test Category</h3>
                </div>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="editCategoryForm">
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
                                    <input type="hidden" class="input form-control" name="category_id" id="category_id" value="{{encrypt($category_details->id)}}">
                                    <input type="text" class="input form-control" name="category_name" id="category_name" placeholder="e.g Full Body Checkup" value="{{$category_details->name}}">
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
                                        @if ($category_details->icon != null)
                                            <div class="flex flex-row justify-center items-center">
                                                <img id="imageFromDB" src="{{ asset('storage/'.$category_details->icon) }}" alt="Image Preview" style="max-width: 350px; max-height:200px; margin-top: 10px; margin-bottom:10px; border-radius: 5px;">
                                            </div>
                                        @else
                                            <svg id="uploadImgSvg" class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        @endif
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
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="submitCategoryBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="grid border border-gray-950 border-dashed rounded-md p-8 mt-5">
                <div>
                    <label class="form-label mb-2">Change Category Status:</label>
                    @if ($category_details->status == 1)
                        <button class="btn bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600 text-white update-account-status" type="button" data-url="{{ route('lab.test.category.update.status') }}" data-id="{{ encrypt($category_details->id) }}" data-status=0>
                            <span class="flex items-center justify-center gap-2">
                                <span class="text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"></path>
                                    </svg>
                                </span>
                                <span>Category Active</span>
                            </span>
                        </button>
                    @else
                        <button class="btn btn-md bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white update-account-status" type="button" data-url="{{ route('lab.test.category.update.status') }}" data-id="{{ encrypt($category_details->id) }}" data-status=1>
                            <span class="flex items-center justify-center gap-2">
                                <span class="text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.143 17.082a24.248 24.248 0 003.844.148m-3.844-.148a23.856 23.856 0 01-5.455-1.31 8.964 8.964 0 002.3-5.542m3.155 6.852a3 3 0 005.667 1.97m1.965-2.277L21 21m-4.225-4.225a23.81 23.81 0 003.536-1.003A8.967 8.967 0 0118 9.75V9A6 6 0 006.53 6.53m10.245 10.245L6.53 6.53M3 3l3.53 3.53"></path>
                                    </svg>
                                </span>
                                <span>Category Disabled</span>
                            </span>
                        </button>
                    @endif
                </div>
                <p class="text-xs my-3 text-red-600">Note: Disabling the category will also disable all the linked tests.</p>
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

            $('#editCategoryForm').on('submit', function(e){
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
                    url: "{{ route('lab.test.category.edit') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response.success === true){
                           toastr.success(response.message);
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
