@extends('layout.main')
@section('title', "Create Hospital")
@section('custom-style')
    <style>
        .invalid-div{
            border: 2px solid rgb(239 68 68);
            border-radius: 5px;
        }
        .toast-position{
            position: absolute;
            top:85px;
            right:50px;
        }
    </style>
@endsection
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Create Hospital</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="createHospitalForm">
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Hospital Name *</label>
                                <div>
                                    <input type="text" class="input form-control" name="hospital_name" id="hospital_name" placeholder="e.g New Age Hospital">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Hospital Address *</label>
                                <div>
                                    <input type="text" class="input form-control" name="hospital_address" id="hospital_address" placeholder="e.g 123, street, gwalior">
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit" id="submitHospitalBtn">Submit</button>
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

            $('#createHospitalForm').on('submit', function(e){
                e.preventDefault();

                $('#submitHospitalBtn').attr('disabled', true);
                $('#submitHospitalBtn').html('Creating...');

                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('hospital.create') }}",
                    type: "POST",
                    data: {
                        'hospital_name': $('#hospital_name').val(),
                        'hospital_address': $('#hospital_address').val()
                    },
                    success:function(response){
                        if(response.success === true){
                           toastr.success(response.message);
                           $('#createHospitalForm')[0].reset();
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
                        $('#submitHospitalBtn').prop('disabled', false);
                        $('#submitHospitalBtn').text('Sign In');
                    }
                });
            });
        });
    </script>
@endsection
