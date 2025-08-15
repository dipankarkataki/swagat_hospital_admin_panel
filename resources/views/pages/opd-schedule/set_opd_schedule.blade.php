@extends('layout.main')
@section('title', 'Set OPD Timing')
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Set OPD Schedule</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="setOpdTimingForm" class="skip-global-submit">

                        <div class="form-container">
                            <div>
                                <input class="input" type="hidden" name="linked_portfolio_id" value="" id="linked_portfolio_id">
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Select Doctor *</label>
                                <div>
                                    <select class="input" name="portfolio_id" id="selectPortfolio" required>
                                        <option value="" disabled selected> Choose </option>

                                        @forelse ($portfolios as $doctor)
                                            <option value="{{ $doctor->id }}">
                                                {{ $doctor->full_name }} : [ {{ $doctor->email }} ]
                                            </option>
                                        @empty
                                            <option value="" disabled>Create portfolio first</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <div class="flex items-center gap-2">
                                    <label class="form-label mb-2">Select Hospital *</label>
                                    <div class="flex items-center">
                                        <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" class="animate-spin text-primary-600 h-[20px] w-[20px] mb-2" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" id="loadingIndicator" style="display: none;">
                                            <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"></path>
                                            <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <select class="input" name="hospital_id" id="selectHospital" required>
                                        <option value=""> Choose </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD Unavailable Dates</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input opd_date" type="date" name="opd_date[]" value="">
                                        <button class="btn btn-solid" id="addAvailableDateBtn">
                                            <span class="flex items-center justify-center gap-2">
                                                <span class="text-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        aria-hidden="true" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v12m6-6H6"></path>
                                                    </svg>
                                                </span>
                                                <span>Add</span>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="opdTimingList"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD Start Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input opd_start_time" type="time" name="opd_start_time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD End Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input opd_end_time" type="time" name="opd_end_time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="setOpdTimingBtn">Submit</button>
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

            let debounceTimer;
            //Get Portfolio Linked Hospitals
            $('#selectPortfolio').on('change', function(e) {
                clearTimeout(debounceTimer); // Clear previous timer
                $('#loadingIndicator').show();
                const hospitalSelect = $('#selectHospital');
                hospitalSelect.empty(); // Clear previous options
                hospitalSelect.append('<option value="" >Choose</option>');

                debounceTimer = setTimeout(() => {
                    const doctor_id = e.target.value;
                    console.log('Doctor ID : ',  doctor_id)
                    if (!doctor_id){
                        $('#loadingIndicator').hide();
                        return;
                    }
                    const portfolio_linked_hospital_url = `/link-hospital/linked-hospital-by-id/${doctor_id}`;

                    $.ajax({
                        url: portfolio_linked_hospital_url,
                        type: "GET",
                        success: function(response) {
                            console.log('Selected Doctor :', response)
                            if (response.success === true) {
                                if (response.data?.length > 0) {
                                    response.data.forEach(hospital => {
                                        const hospitalName = hospital.hospitals?.name || 'Unnamed';
                                        const hospitalId = hospital.hospital_id;
                                        const linked_portfolio_id = hospital.id;
                                        hospitalSelect.append(`<option value="${hospitalId}">${hospitalName}</option>`);
                                        $('#linked_portfolio_id').val(linked_portfolio_id);
                                    });
                                    toastr.success(response.message);
                                } else {
                                    hospitalSelect.append(`<option value="">No hospital found :( </option>`);
                                    toastr.error( 'Oops! No hospital is linked with this portfolio. Assign a hospital first to set OPD timings.');
                                }
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr) {
                                toastr.error('Oops! Something went wrong. Please try again.');
                            }
                        },
                        complete: function() {
                            $('#loadingIndicator').hide();
                        }
                    });
                }, 2000);
            });

            //Save OPD Timings
            $('#setOpdTimingForm').on('submit', function(e){
                e.preventDefault();
                const formData = new FormData(this);

                // Disable button immediately
                $('#setOpdTimingBtn').attr('disabled', true).text('Please wait...');

                // let hasEmptyDate = false;

                // $('.opd_date').each(function() {
                //     if (!$(this).val()) {
                //         hasEmptyDate = true;
                //     }
                // });

                // if (hasEmptyDate) {
                //     toastr.error('Please select all OPD dates before submitting.');
                //     $('#setOpdTimingBtn').attr('disabled', false).text('Submit');
                //     return;
                // }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('opd.set.schedule')}}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log('OpD Response', response)
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
                        $('#setOpdTimingBtn').attr('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
