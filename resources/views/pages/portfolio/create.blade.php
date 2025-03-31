@extends('layout.main')
@section('title', "Create Doctor's Portfolio")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Create Portfolio</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="form-validation">
                        <div class="form-container">
                            <div class="form-item">
                                <div class="grid xl:grid-cols-4">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">Profile Picture</label>
                                        <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                            <div>
                                                <input class="upload-input draggable" name="uploadProfilePicture" type="file" title="" value="">
                                            </div>
                                            <div class="text-center">
                                                <svg class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>                                      
                                                <p class="font-semibold">
                                                    <span class="text-gray-800 dark:text-white">Drop your image here, or</span>
                                                    <span class="text-blue-500">browse</span>
                                                </p>
                                                <p class="mt-1 opacity-60 dark:text-white">Support: jpeg, png</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Required *</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputRequired" placeholder="Required *">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Min Length</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputMinLength" placeholder="Enter minimum 8 characters">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Max Length</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputMaxLength"
                                        placeholder="Enter maximum 8 characters">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Range length</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputRangeLength"
                                        placeholder="Enter minimum 2 & maximum 6 characters" required>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Min Value</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputMinValue"
                                        placeholder="Enter number more than 8">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Max Value</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputMaxValue"
                                        placeholder="Enter number less than 6">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Range Value</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputRangeValue"
                                        placeholder="Enter number between 6 to 12">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Email</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputEmail"
                                        placeholder="Enter a valid email">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Confirm Password</label>
                                <div>
                                    <input id="password" type="text" class="input form-control" name="inputPassword"
                                        placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">URL</label>
                                <div>
                                    <input type="url" class="input form-control" name="inputUrl" placeholder="Enter a valid URL"
                                        required>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Digit</label>
                                <div>
                                    <input type="url" class="input form-control" name="inputDigit" placeholder="Enter a Digit"
                                        required>
                                </div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit">
                                        Submit
                                    </button>
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
        $('#form-validation').validate({
            ignore: ':hidden:not(:checkbox)',
            errorElement: 'div',
            errorClass: 'input-invalid',
            validClass: 'input-valid',
            errorPlacement: function(error, element) {
                error.addClass('text-red-500 mt-1');
                error.removeClass('input-valid');
                if (element.prop('type') === 'checkbox') {
                    error.insertAfter(element.parent('label'));
                } else if(element.prop('type') === 'file'){
                    const uploadDiv = element.closest('.upload');

                    error.insertAfter(uploadDiv);
                    uploadDiv.css({
                        'border': '2px dashed rgb(239 68 68)'
                    });
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                uploadProfilePicture:{
                    required: true
                },

                inputRequired: {
                    required: true
                },
                inputMinLength: {
                    required: true,
                    minlength: 6
                },
                inputMaxLength: {
                    required: true,
                    minlength: 8
                },
                inputUrl: {
                    required: true,
                    url: true
                },
                inputRangeLength: {
                    required: true,
                    rangelength: [2, 6]
                },
                inputMinValue: {
                    required: true,
                    min: 8
                },
                inputMaxValue: {
                    required: true,
                    max: 6
                },
                inputRangeValue: {
                    required: true,
                    max: 6,
                    range: [6, 12]
                },
                inputEmail: {
                    required: true,
                    email: true
                },
                inputPassword: {
                    required: true
                },
                inputPasswordConfirm: {
                    required: true,
                    equalTo: '#password'
                },
                inputDigit: {
                    required: true,
                    digits: true
                },
                inputValidCheckbox: {
                    required: true
                }
            }
        });

        $('input[name="uploadProfilePicture"]').on('change', function() {
            const uploadDiv = $(this).closest('.upload');

            if ($(this).val()) {
                uploadDiv.css({
                    'border': ''  // Reset border
                });
            }
        });
    </script>
@endsection
