@extends('layout.main')
@section('title', 'Edit Lab Test Package')
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-4">
                    <a href="{{route('lab.package.test.get.list')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"></path>
                        </svg>
                    </a>
                    <h3>Edit Lab Test Package</h3>
                </div>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="editLabTestPackageForm" class="skip-global-submit">
                        <div class="form-container">
                            <input type="hidden" name="package_id" value="{{encrypt($package_details->id)}}" >
                            <div class="form-item">
                                <label class="form-label mb-2">Package Name *
                                    <span class="cursor-pointer" data-bs-toggle="tooltip" data-bs-title="Please donot enter the word 'Package' after the package name. For e.g correct Name -> Swagat Full Body Checkup. Incorrect Name -> Swagat Full Body Checkup Package">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                                        </svg>
                                    </span>
                                </label>
                                <div class="mb-4">
                                    <input class="input" type="text" name="package_name" id="package_name" placeholder="e.g. Full Body Checkup" value="{{$package_details->name}}" required>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Test Category *</label>
                               <div>
                                    <select class="input select-lab-category" id="selectCategory" multiple="multiple" name="category_id[]" required>
                                        @foreach ($lab_test_category as $test_category)
                                            @php
                                                $isSelected = in_array($test_category->id, $selected_categories ?? []);
                                            @endphp

                                            <option value="{{ encrypt($test_category->id) }}" {{ $isSelected ? 'selected' : '' }}>
                                                {{ $test_category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <div class="flex items-center gap-2">
                                    <label class="form-label mb-2">Select Test *</label>
                                    <div class="flex items-center">
                                        <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" class="animate-spin text-primary-600 h-[20px] w-[20px] mb-2" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" id="loadingIndicator" style="display: none;">
                                            <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"></path>
                                            <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <select class="input select-lab-test" id="selectLabTest" multiple="multiple" required>
                                        <option value=""> Choose </option>
                                        @php
                                            $selected_ids = json_decode($package_details->lab_test_id, true);
                                        @endphp

                                        @foreach ($all_lab_test as $lab_test)
                                            @php
                                                $value = $lab_test->id . '-' . $lab_test->price;
                                                $isSelected = in_array($lab_test->id, $selected_ids ?? []);
                                            @endphp

                                            <option value="{{ $value }}" {{ $isSelected ? 'selected' : '' }}>
                                                {{ $lab_test->name }} : [ price -- ₹ {{ $lab_test->price }} ]
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Description *</label>
                                <div>
                                    <textarea class="input input-textarea" name="package_desc" placeholder="Type test description here..." maxlength="200" required>{{$package_details->description}}</textarea>
                                    <span class="ml-1 text-xs">Maximum allowed characters 200.</span>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Amount *</label>
                                <div class="mb-4">
                                    <input class="input amount-input" type="text" name="package_amount" id="package_amount" placeholder="e.g. 999.23" value="{{$package_details->full_price}}" readonly required>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Discount (in %)</label>
                                <div class="mb-4">
                                    <input class="input" type="text" name="package_discount" id="package_discount" value="{{$package_details->discount}}" placeholder="e.g. 10">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Discounted Amount</label>
                                <div class="mb-4">
                                    <input class="input amount-input" type="text" name="package_discounted_amount"  id="package_discounted_amount" value="{{$package_details->discounted_price}}" placeholder="e.g. 999.23" readonly>
                                </div>
                            </div>
                            <div class="form-item">
                                <div>
                                    <button class="btn btn-default" type="submit" id="submitLabTestPackageBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="grid border border-gray-950 border-dashed rounded-md p-8 mt-5">
                <div>
                    <label class="form-label mb-2">Change Package Status:</label>
                    @if ($package_details->status == 1)
                        <button class="btn bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600 text-white update-account-status" type="button" data-url="{{ route('lab.package.test.update.status') }}" data-id="{{ encrypt($package_details->id) }}" data-status=0>
                            <span class="flex items-center justify-center gap-2">
                                <span class="text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"></path>
                                    </svg>
                                </span>
                                <span>Package Active</span>
                            </span>
                        </button>
                    @else
                        <button class="btn btn-md bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white update-account-status" type="button" data-url="{{ route('lab.package.test.update.status') }}" data-id="{{ encrypt($package_details->id) }}" data-status=1>
                            <span class="flex items-center justify-center gap-2">
                                <span class="text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.143 17.082a24.248 24.248 0 003.844.148m-3.844-.148a23.856 23.856 0 01-5.455-1.31 8.964 8.964 0 002.3-5.542m3.155 6.852a3 3 0 005.667 1.97m1.965-2.277L21 21m-4.225-4.225a23.81 23.81 0 003.536-1.003A8.967 8.967 0 0118 9.75V9A6 6 0 006.53 6.53m10.245 10.245L6.53 6.53M3 3l3.53 3.53"></path>
                                    </svg>
                                </span>
                                <span>Package Disabled</span>
                            </span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {

            // Amount Input Validation
            let typingTimers = {};
            const amountInputs = document.querySelectorAll(".amount-input");

            amountInputs.forEach((amountInput, index) => {
                // Allow only digits and one decimal
                amountInput.addEventListener("keypress", (e) => {
                    const char = String.fromCharCode(e.which || e.keyCode);
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
                    clearTimeout(typingTimers[index]);

                    typingTimers[index] = setTimeout(() => {
                        const value = amountInput.value.trim();
                        const regex = /^\d{1,4}(\.\d{1,2})?$/;
                        if (!regex.test(value)) {
                            toastr.error("Invalid amount. Maximum 9999.99 allowed");
                        } else {
                            toastr.clear();
                        }
                    }, 500); // delay after user stops typing
                });
            });

            //Get Category Linked Lab Tests
            let debounceTimer;

            $('#selectCategory').on('change', function(e) {
                clearTimeout(debounceTimer);
                $('#loadingIndicator').show();

                // Reset amounts
                $('#package_amount').val('');
                $('#package_discounted_amount').val('');
                $('#package_discount').val('');

                debounceTimer = setTimeout(() => {
                    const category_ids = $(this).val(); // selected categories

                    // ✅ Capture selected tests BEFORE clearing
                    const previouslySelected = $('#selectLabTest').val() || [];

                    const labTestSelect = $('#selectLabTest');
                    labTestSelect.empty();
                    labTestSelect.append('<option value="">Choose</option>');

                    if (!category_ids || category_ids.length === 0) {
                        $('#loadingIndicator').hide();
                        return;
                    }

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('lab.package.test.get.by.categories') }}",
                        type: "POST",
                        data: { category_ids: category_ids },
                        success: function(response) {
                            if (response.success === true) {
                                if (response.data?.length > 0) {
                                    response.data.forEach(labTest => {
                                        const labTestId = labTest.id;
                                        const labTestName = labTest.name || 'Unnamed';
                                        const labTestPrice = labTest.price;
                                        const optionValue = `${labTestId}-${labTestPrice}`;

                                        const isSelected = previouslySelected.includes(optionValue) ? 'selected' : '';

                                        labTestSelect.append(
                                            `<option value="${optionValue}" ${isSelected}>
                                                ${labTestName} : [ price -- ₹ ${labTestPrice} ]
                                            </option>`
                                        );
                                    });

                                    // ✅ Trigger recalculation after updating options
                                    labTestSelect.trigger('change');

                                    toastr.success(response.message);
                                } else {
                                    labTestSelect.append(`<option value="">No lab test found :( </option>`);
                                    toastr.error('Oops! No lab test is linked with this category.');
                                }
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Oops! Something went wrong. Please try again.');
                        },
                        complete: function() {
                            $('#loadingIndicator').hide();
                        }
                    });
                }, 500);
            });


            //Get Selected Lab Test ID and Price
            $('#selectLabTest').on('change', function(e){

                const selectedValues = $(this).val(); // This is an array of selected values
                if (!selectedValues || selectedValues.length === 0) {
                    console.log('No lab test selected');
                    $('#package_amount').val('');
                    $('#package_discounted_amount').val('');
                    $('#package_discount').val('');
                    return;
                }
                let labTestTotalAmount = 0;
                selectedValues.forEach(value => {
                    const [labTestId, labTestPrice] = value.split('-');
                    labTestTotalAmount += parseFloat(labTestPrice) || 0;
                });

                $('#package_amount').val(labTestTotalAmount.toFixed(2));
                const package_discount = @json($package_details->discount);
                if(package_discount){
                    $('#package_discount').val(package_discount);
                    const discounted_amount = parseFloat(labTestTotalAmount * package_discount /100).toFixed(2);
                    const total_amount_after_discount = discounted_amount > 0 ? parseFloat(labTestTotalAmount - discounted_amount).toFixed(2) : '';
                    $('#package_discounted_amount').val(total_amount_after_discount);
                }
            });

            //Apply discount on package total amount
            $('#package_discount').on('input', function(){
                const discount_percentage = $(this).val();
                if(discount_percentage > 100){
                    toastr.error('Oops! Discount cannot be more that 100%');
                    return;
                }
                const total_package_amount = $('#package_amount').val();
                const discounted_amount = parseFloat(total_package_amount * discount_percentage /100).toFixed(2);
                const total_amount_after_discount = discounted_amount > 0 ? parseFloat(total_package_amount - discounted_amount).toFixed(2) : '';

                $('#package_discounted_amount').val(total_amount_after_discount);
            });


            //Create Lab Test Package
            $('#editLabTestPackageForm').on('submit', function(e){
                e.preventDefault();

                const formData = new FormData(this);

                const selectedValues = $('#selectLabTest').val();
                const selectedTestIDs = [];

                selectedValues.forEach(value => {
                    const [id, price] = value.split('-');
                    if (!selectedTestIDs.includes(id)) {
                        selectedTestIDs.push(id);
                    }
                });

                // Now append each ID separately to formData
                selectedTestIDs.forEach(id => {
                    formData.append('lab_test_id[]', id);
                });


                $('#submitLabTestPackageBtn').attr('disabled', true).text('Please wait...');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('lab.package.test.edit')}}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log("Response :--: ", response)
                        if(response.success === true){
                            toastr.success(response.message);
                            location.reload();
                        }else{
                            toastr.error(response.message);
                        }
                    }, error: function(xhr){
                        if(xhr){
                            toastr.error('Oops! Something went wrong. Please try again.');
                        }
                    },complete: function(){
                        $('#submitLabTestPackageBtn').attr('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
