@extends('layout.main')
@section('title', 'Create Lab Test')
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Create Lab Test</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="createLabTestForm" class="skip-global-submit">
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Select Category *</label>
                                <div>
                                    <select class="input" name="category_id" id="categoryId" required>
                                        <option value="" disabled selected> Choose </option>

                                        @foreach ($lab_test_categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                               <label class="form-label mb-2">Test Name *
                                    <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Please donot enter the word 'Test' after the test name. For e.g correct Name -> SODIUM - SERUM. Incorrect Name -> SODIUM - SERUM Test">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                        </svg>
                                    </span>
                                </label>
                                <div class="input-group mb-4">
                                    <input class="input" type="text" name="test_name" placeholder="e.g HBsAg - Quantitative (CMIA)" required>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Description</label>
                                <div class="input-group mb-4">
                                    <textarea class="input input-textarea" name="test_desc" placeholder="Type test description here..."></textarea>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Amount</label>
                                <div class="input-group mb-4">
                                    <input class="input" type="text" name="test_amount" id="test_amount" placeholder="₹ 999.23" required>
                                </div>
                            </div>
                            <div class="form-item">
                                <div>
                                    <button class="btn btn-default" type="submit" id="submitLabTestForm">Submit</button>
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

            //Amount Input Validation
            let typingTimer;
            const amountInput = document.getElementById("test_amount");

            // Allow only digits and one decimal
            amountInput.addEventListener("keypress", (e) => {
            const char = String.fromCharCode(e.which);
            const currentValue = amountInput.value;

            // Block multiple decimals
            if (char === "." && currentValue.includes(".")) {
                e.preventDefault();
                return;
            }

            // Allow only digits or one decimal
            if (!/[0-9.]/.test(char)) {
                e.preventDefault();
            }
            });

            // Optional: block paste of invalid characters
            amountInput.addEventListener("paste", (e) => {
            const paste = (e.clipboardData || window.clipboardData).getData("text");
            if (!/^\d{0,4}(\.\d{0,2})?$/.test(paste)) {
                e.preventDefault();
                toastr.error("Only numeric values up to 9999.99 allowed");
            }
            });

            // Validate after user stops typing
            amountInput.addEventListener("input", () => {
            clearTimeout(typingTimer);

            typingTimer = setTimeout(() => {
                const value = amountInput.value.trim();
                const regex = /^\d{1,4}(\.\d{1,2})?$/;

                if (!regex.test(value)) {
                toastr.error("Invalid amount. Maximum 9999.99 allowed");
                } else {
                toastr.clear();
                }
            }, 500); // delay after user stops typing
            });


            //Create Lab Test
            $('#createLabTestForm').on('submit', function(e){
                e.preventDefault();

                const formData = new FormData(this);

                $('#submitLabTestForm').attr('disabled', true).text('Please wait...');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('lab.test.create')}}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.success === true){
                            toastr.success(response.message);
                            $('#createLabTestForm')[0].reset();
                        }else{
                            toastr.error(response.message);
                        }
                    }, error: function(xhr){
                        if(xhr){
                            toastr.error('Oops! Something went wrong. Please try again.');
                        }
                    },complete: function(){
                        $('#submitLabTestForm').attr('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
