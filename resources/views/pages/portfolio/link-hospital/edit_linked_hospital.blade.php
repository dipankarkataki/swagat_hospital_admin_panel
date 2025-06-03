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
