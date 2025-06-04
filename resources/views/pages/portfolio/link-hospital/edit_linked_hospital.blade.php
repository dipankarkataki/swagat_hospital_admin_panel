@extends('layout.main')
@section('title', "Link Portfolio With Hospital")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-4">
                    <a href="{{route('portfolio.linked.hospital.list')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"></path>
                        </svg>
                    </a>
                    <h3>Edit Linked Hospital</h3>
                </div>
            </div>
            <div class="mb-4">
                <p>
                    <span class="text-red-500">Note:</span> When a hospital is replaced, all its existing OPD timings will be moved to the new hospital, if available.
                </p>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="editHospitalForm">
                        @csrf
                        <div class="form-container">
                            <div>
                                <input class="input" type="hidden" name="linked_hosp_id" value="{{encrypt($linked_hospital->id)}}" required>
                                <input class="input" type="hidden" name="portfolio_id" value="{{$linked_hospital->portfolio_id}}" required>
                                <input class="input" type="hidden" name="old_hosp_id" value="{{$linked_hospital->hospital_id}}" required>
                                <div class="form-item">
                                    <label class="form-label mb-2">Doctor *</label>
                                    <div>
                                        <input class="input" type="text" name="fullName" value="{{$linked_hospital->portfolio->full_name}} : [{{$linked_hospital->portfolio->email}}]" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Linked Hospital
                                    <span class="text-xs ml-2 font-normal">( Use dropdown to select and link new hospital ) </span> *
                                </label>
                                <div>
                                    <select class="input" name="new_hospital_id" id="hospital_id" required>
                                        <option value="" disabled>Choose</option>

                                        @foreach ($all_hospitals as $hospital)
                                            <option value="{{ $hospital->id }}" {{ $linked_hospital->hospital_id == $hospital->id ? 'selected' : '' }}>{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="editHospitalBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid border border-gray-950 border-dashed rounded-md p-8 mt-5">
                <div>
                    <label class="form-label mb-2">Change Linked Hospital Status:</label>
                    @if ($linked_hospital->status == 1)
                        <button class="btn bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600 text-white update-account-status" type="button" data-url="{{ route('opd.update.schedule.status') }}" data-id="{{ encrypt($linked_hospital->id) }}" data-status=0>
                            <span class="flex items-center justify-center gap-2">
                                <svg class="menu-item-icon" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <span>Hospital Active</span>
                            </span>
                        </button>
                    @else
                        <button class="btn btn-md bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white update-account-status" type="button" data-url="{{ route('opd.update.schedule.status') }}" data-id="{{ encrypt($linked_hospital->id) }}" data-status=1>
                            <span class="flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0" stroke="currentColor" aria-hidden="true" height="1em" width="1em" class="menu-item-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"></path>
                                </svg>
                                <span>Hospital Disabled</span>
                            </span>
                        </button>
                    @endif
                </div>
                {{-- <p class="text-xs my-3 text-red-600">Note: Disabling the schedule status will prevent patients from booking appointments for this hospital.</p> --}}
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {

            //Ajax Call To Update Appointment Application Status
            $('#editHospitalForm').on('submit', function(e){
                e.preventDefault();

                const formData = new FormData(this);
                $('#editHospitalBtn').attr('disabled', true).text('Please wait...');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('portfolio.save.linked.edited.hospital') }}",
                    type:"POST",
                    processData: false,
                    contentType: false,
                    data:formData,
                    success:function(response){
                        if(response.success === true){
                            toastr.success(response.message);
                            // location.reload();
                        }else{
                            toastr.error(response.message);
                        }
                    },error:function(xhr, status, error){
                        if(xhr){
                            toastr.error('Oops! Something went wrong. Please try again.');
                            $('#editHospitalBtn').attr('disabled', false).text('Submit');
                        }
                    },complete:function(){
                        $('#editHospitalBtn').attr('disabled', false).text('Submit');
                    }
                });
            });

        });
    </script>
@endsection
