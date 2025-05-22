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
                    <form id="assignNewHospital" method="POST" action="{{ route('portfolio.hospital.assign') }}">
                        @csrf
                        <div class="form-container">
                            <div class="form-item">
                                <label class="form-label mb-2">Select Doctor *</label>
                                <div>
                                    <select class="input @error('doctor_id') invalid-div @enderror" name="doctor_id">
                                        <option value=""> Choose </option>

                                        @foreach ($portfolios as $doctor)
                                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                                <div class="flex items-center">
                                                    <span class="avatar avatar-circle w-[30px]" data-avatar-size="30">
                                                        <img class="avatar-img avatar-circle" src="{{ asset('storage/' . $doctor->profile_pic) }}" loading="lazy">
                                                    </span>
                                                    <a class="hover:text-primary-600 ml-2 rtl:mr-2 font-semibold">{{ $doctor->full_name }}</a>
                                                </div>
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
                                    <select class="input @error('hospital_id') invalid-div @enderror" name="hospital_id">
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
                                    <button class="btn btn-default" type="submit" id="submitPortfolioBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('common.session_message')
@endsection
