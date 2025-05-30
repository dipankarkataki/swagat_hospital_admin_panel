@extends('layout.main')
@section('title', 'Set OPD Timing')
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Set OPD Timing</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form>
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Select Doctor *</label>
                                <div>
                                    <select class="input" name="doctor_id" id="selectPortfolio">
                                        <option value=""> Choose </option>

                                        @foreach ($portfolios as $doctor)
                                            <option value="{{ $doctor->id }}">
                                                {{ $doctor->full_name }} : [ {{ $doctor->email }} ]
                                            </option>
                                        @endforeach
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
                                    <select class="input" name="hospital_id" id="selectHospital">
                                        <option value=""> Choose </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD Date</label>
                                <div>
                                    <div class="input-group mb-4">
                                        @php $opdDates = old('opdDate', []); @endphp
                                        <input class="input opdDate @error('opdDate') input-invalid @enderror"
                                            type="date" name="opdDate[]" value={{ $opdDates[0] ?? '' }}>
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
                                    @foreach (array_slice($opdDates, 1) as $opdDate)
                                        <div class="input-group mb-4 available-date-item">
                                            <input class="input opdDate" type="datetime-local" name="opdDate[]"
                                                value={{ $opdDate }}>
                                            <button
                                                class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white removeAvailableDateTimeBtn">
                                                <span class="flex items-center justify-center gap-2">
                                                    <span class="text-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            aria-hidden="true" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    <span>Del</span>
                                                </span>
                                            </button>
                                        </div>
                                    @endforeach
                                    <div id="availableDateTimeList"></div>
                                    @error('opdDate')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD Start Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input opdStartTime @error('opdStartTime') input-invalid @enderror"
                                            type="time" name="opdStartTime" value={{ old('opdStartTIme') }}>
                                    </div>
                                    @error('opdStartTime')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD End Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input opdEndTime @error('opdEndTime') input-invalid @enderror"
                                            type="time" name="opdEndTime" value={{ old('opdEndTime') }}>
                                    </div>
                                    @error('opdEndTime')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="assignHospitalBtn">Submit</button>
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

                debounceTimer = setTimeout(() => {
                    const doctor_id = e.target.value;
                    if (!doctor_id) return;
                    const portfolio_linked_hospital_url = `/portfolio/hospital/linked-portfolio/${doctor_id}`;

                    $.ajax({
                        url: portfolio_linked_hospital_url,
                        type: "GET",
                        success: function(response) {
                            console.log('Selected Doctor :', response)
                            if (response.success === true) {
                                if (response.data?.length > 0) {

                                    const hospitalSelect = $('#selectHospital');
                                    hospitalSelect.empty(); // Clear previous options
                                    hospitalSelect.append('<option value="">Choose</option>');

                                    response.data.forEach(hospital => {
                                        const hospitalName = hospital.hospitals?.name || 'Unnamed';
                                        const hospitalId = hospital.hospital_id;
                                        hospitalSelect.append(`<option value="${hospitalId}">${hospitalName}</option>`);
                                    });

                                    toastr.success(response.message);
                                } else {
                                    const hospitalSelect = $('#selectHospital');
                                    hospitalSelect.empty();
                                    hospitalSelect.append('<option value="">Choose</option>');
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
        });
    </script>
@endsection
