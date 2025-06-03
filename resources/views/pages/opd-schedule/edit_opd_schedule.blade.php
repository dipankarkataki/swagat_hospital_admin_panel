@extends('layout.main')
@section('title', 'Set OPD Timing')
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-4">
                    <a href="{{route('opd.get.list.of.schedules')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"></path>
                        </svg>
                    </a>
                    <h3>Edit OPD Schedule</h3>
                </div>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="editOpdTimingForm" class="skip-global-submit">
                        <div class="form-container">
                            <input class="input" type="hidden" name="opd_timing_id" value="{{encrypt($opd_schedule->id)}}" required>
                            <div class="form-item">
                                <label class="form-label mb-2">Doctor *</label>
                                <div>
                                    <input class="input" type="text" name="portfolio_id" value="{{$opd_schedule->portfolio->full_name}} : [{{$opd_schedule->portfolio->email}}]" required readonly>
                                </div>
                            </div>
                            <div class="form-item">
                                <div class="flex items-center gap-2">
                                    <label class="form-label mb-2">Linked Hospital *</label>
                                    {{-- <div class="flex items-center">
                                        <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" class="animate-spin text-primary-600 h-[20px] w-[20px] mb-2" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" id="loadingIndicator" style="display: none;">
                                            <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"></path>
                                            <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                                        </svg>
                                    </div> --}}
                                </div>
                                <div>
                                    <div>
                                        <input class="input" type="text" name="hospital_id" value="{{$opd_schedule->hospital->name}}" required readonly>
                                    </div>
                                    {{-- <select class="input" name="hospital_id" id="selectHospital" required>
                                        <option value=""> Choose </option>
                                        @foreach ($get_hospital_list as $hospital)
                                            <option value="{{$hospital->id}}" {{$hospital->id == $opd_schedule->hospital_id ? 'selected' : null }}>{{$hospital->name}}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD Date</label>
                                <div>
                                    <div class="input-group mb-4">
                                        @php $opd_dates = json_decode($opd_schedule->opd_date ?? '[]', true) ?? []; @endphp
                                        <input class="input opd_date" type="date" name="opd_date[]" value="{{ $opd_dates[0] ?? '' }}" required>
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
                                    @foreach(array_slice($opd_dates, 1) as $opd_date)
                                        <div class="input-group mb-4 available-date-item">
                                            <input class="input opd_date" type="date" name="opd_date[]" value="{{ $opd_date }}" required>
                                            <button class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white removeAvailableDateTimeBtn">
                                                <span class="flex items-center justify-center gap-2">
                                                    <span class="text-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                        </svg>
                                                    </span>
                                                    <span>Del</span>
                                                </span>
                                            </button>
                                        </div>
                                    @endforeach
                                    <div id="opdTimingList"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD Start Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input opd_start_time" type="time" name="opd_start_time" value="{{$opd_schedule->opd_start_time}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD End Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input opd_end_time" type="time" name="opd_end_time" value="{{$opd_schedule->opd_end_time}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="editOpdTimingBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid border border-gray-950 border-dashed rounded-md p-8 mt-5">
                <div>
                    <label class="form-label mb-2">Change OPD Schedule Status:</label>
                    @if ($opd_schedule->status == 1)
                        <button class="btn bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600 text-white update-account-status" type="button" data-url="{{ route('opd.update.schedule.status') }}" data-id="{{ encrypt($opd_schedule->id) }}" data-status=0>
                            <span class="flex items-center justify-center gap-2">
                                <span class="text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"></path>
                                    </svg>
                                </span>
                                <span>Schedule Active</span>
                            </span>
                        </button>
                    @else
                        <button class="btn btn-md bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white update-account-status" type="button" data-url="{{ route('opd.update.schedule.status') }}" data-id="{{ encrypt($opd_schedule->id) }}" data-status=1>
                            <span class="flex items-center justify-center gap-2">
                                <span class="text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.143 17.082a24.248 24.248 0 003.844.148m-3.844-.148a23.856 23.856 0 01-5.455-1.31 8.964 8.964 0 002.3-5.542m3.155 6.852a3 3 0 005.667 1.97m1.965-2.277L21 21m-4.225-4.225a23.81 23.81 0 003.536-1.003A8.967 8.967 0 0118 9.75V9A6 6 0 006.53 6.53m10.245 10.245L6.53 6.53M3 3l3.53 3.53"></path>
                                    </svg>
                                </span>
                                <span>Schedule Disabled</span>
                            </span>
                        </button>
                    @endif
                </div>
                <p class="text-xs my-3 text-red-600">Note: Disabling the schedule status will prevent patients from booking appointments for this hospital.</p>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {

            let debounceTimer;
            //Get Portfolio Linked Hospitals
            // $('#selectPortfolio').on('change', function(e) {
            //     clearTimeout(debounceTimer); // Clear previous timer
            //     $('#loadingIndicator').show();
            //     const hospitalSelect = $('#selectHospital');
            //     hospitalSelect.empty(); // Clear previous options
            //     hospitalSelect.append('<option value="" >Choose</option>');

            //     debounceTimer = setTimeout(() => {
            //         const doctor_id = e.target.value;
            //         console.log('Doctor ID : ',  doctor_id)
            //         if (!doctor_id){
            //             $('#loadingIndicator').hide();
            //             return;
            //         }
            //         const portfolio_linked_hospital_url = `/portfolio/hospital/linked-portfolio/${doctor_id}`;

            //         $.ajax({
            //             url: portfolio_linked_hospital_url,
            //             type: "GET",
            //             success: function(response) {
            //                 console.log('Selected Doctor :', response)
            //                 if (response.success === true) {
            //                     if (response.data?.length > 0) {
            //                         response.data.forEach(hospital => {
            //                             const hospitalName = hospital.hospitals?.name || 'Unnamed';
            //                             const hospitalId = hospital.hospital_id;
            //                             hospitalSelect.append(`<option value="${hospitalId}">${hospitalName}</option>`);
            //                         });
            //                         toastr.success(response.message);
            //                     } else {
            //                         hospitalSelect.append(`<option value="">No hospital found :( </option>`);
            //                         toastr.error( 'Oops! No hospital is linked with this portfolio. Assign a hospital first to set OPD timings.');
            //                     }
            //                 } else {
            //                     toastr.error(response.message);
            //                 }
            //             },
            //             error: function(xhr, status, error) {
            //                 if (xhr) {
            //                     toastr.error('Oops! Something went wrong. Please try again.');
            //                 }
            //             },
            //             complete: function() {
            //                 $('#loadingIndicator').hide();
            //             }
            //         });
            //     }, 2000);
            // });

            //Save OPD Timings
            $('#editOpdTimingForm').on('submit', function(e){
                e.preventDefault();
                const formData = new FormData(this);

                // Disable button immediately
                $('#editOpdTimingBtn').attr('disabled', true).text('Please wait...');

                let hasEmptyDate = false;

                $('.opd_date').each(function() {
                    if (!$(this).val()) {
                        hasEmptyDate = true;
                    }
                });

                if (hasEmptyDate) {
                    toastr.error('Please select all OPD dates before submitting.');
                    $('#setOpdTimingBtn').attr('disabled', false).text('Submit');
                    return;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('opd.edit.schedule')}}",
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
                        $('#editOpdTimingBtn').attr('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
