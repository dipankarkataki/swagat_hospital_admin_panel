@extends('layout.main')
@section('title', "Assign New Hospital")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Assign New Hospital</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="assignNewHospitalForm">
                        @csrf
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Select Doctor *</label>
                                <div>
                                    <select class="input @error('doctor_id') invalid-div @enderror" name="doctor_id" id="doctor_id">
                                        <option value=""> Choose </option>

                                        @foreach ($portfolios as $doctor)
                                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                                {{ $doctor->full_name }} : ( {{$doctor->email}} )
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('hospital_id')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Assign Hospital *</label>
                                <div>
                                    <select class="input @error('hospital_id') invalid-div @enderror" name="hospital_id" id="hospital_id">
                                        <option value="">Choose</option>

                                        @foreach ($list_of_hospitals as $hospital)
                                            <option value="{{ $hospital->id }}" {{ old('hospital_id') == $hospital->id ? 'selected' : '' }}>{{ $hospital->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('hospital_id')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
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

            //Ajax Call To Update Appointment Application Status
            $('#assignNewHospitalForm').on('submit', function(e){
                e.preventDefault();

                const formData = new FormData(this);
                $('#assignHospitalBtn').attr('disabled', true).text('Please wait...');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('portfolio.hospital.assign') }}",
                    type:"POST",
                    processData: false,
                    contentType: false,
                    data:formData,
                    success:function(response){
                        if(response.success === true){
                            toastr.success(response.message);
                            $('#assignNewHospitalForm')[0].reset();
                        }else{
                            toastr.error(response.message);
                        }
                    },error:function(xhr, status, error){
                        if(xhr){
                            toastr.error('Oops! Something went wrong. Please try again.');
                            $('#assignHospitalBtn').attr('disabled', false).text('Submit');
                        }
                    },complete:function(){
                        $('#assignHospitalBtn').attr('disabled', false).text('Submit');
                    }
                });
            });

        });
    </script>
@endsection
