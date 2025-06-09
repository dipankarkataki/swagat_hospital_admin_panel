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

            $('#createCategoryForm').on('submit', function(e){
                e.preventDefault();

                const formData = new FormData(this);

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
                           $('#createCategoryForm')[0].reset();
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
