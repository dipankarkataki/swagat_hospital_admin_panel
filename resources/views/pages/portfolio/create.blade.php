@extends('layout.main')
@section('title', "Create Doctor's Portfolio")
@section('content')
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto">
            <div class=" mb-4">
                <h3>Create Portfolio</h3>
            </div>
            <div class="card card-border">
                <div class="card-body">
                    <form id="form-validation">
                        <div class="form-container">
                            <div class="form-item">
                                <div class="grid xl:grid-cols-4">
                                    <div class="form-item vertical">
                                        <label class="form-label mb-2">Profile Picture *</label>
                                        <div
                                            class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                            <div>
                                                <input class="upload-input draggable" name="uploadProfilePicture"
                                                    type="file" title="" value="" required>
                                            </div>
                                            <div class="text-center">
                                                <svg class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                                <p class="font-semibold">
                                                    <span class="text-gray-800 dark:text-white">Drop your image here,
                                                        or</span>
                                                    <span class="text-blue-500">browse</span>
                                                </p>
                                                <p class="mt-1 opacity-60 dark:text-white">Support: jpeg, png</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Full Name *</label>
                                <div>
                                    <input type="text" class="input form-control" name="fullName"
                                        placeholder="Required *" required>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Choose Years of Experience *</label>
                                <div>
                                    <select class="input" name="yearsOfExperience" required>
                                        <option selected>Choose years</option>
                                        @for ($i = 1; $i <= 60; $i++)
                                            <option value="{{ $i }}">Years of Experience : {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Choose Linked Department *</label>
                                <div>
                                    <select class="input" name="department" required>
                                        <option selected>Choose department</option>
                                        <option value="gynacology">Gynachology</option>
                                        <option value="medicine">Medicine</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Languages Speak</label>
                                <div>
                                    <input type="text" class="input form-control" name="languagesSpeak"
                                        placeholder="Enter languages separated by comma(,)">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Brief Description *</label>
                                <div>
                                    <textarea class="input input-textarea" placeholder="Write a brief description about the doctor, his work etc." required></textarea>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Add Expertise</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input expertise" type="text" name="expertise[]" placeholder="e.g Expert in Robotic Surgery">
                                        <button class="btn btn-solid" id="addExpertiseBtn"> + Add </button>
                                    </div>
                                    <div id="expertiseList"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Max Value</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputMaxValue"
                                        placeholder="Enter number less than 6">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Range Value</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputRangeValue"
                                        placeholder="Enter number between 6 to 12">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Email</label>
                                <div>
                                    <input type="text" class="input form-control" name="inputEmail"
                                        placeholder="Enter a valid email">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Confirm Password</label>
                                <div>
                                    <input id="password" type="text" class="input form-control" name="inputPassword"
                                        placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">URL</label>
                                <div>
                                    <input type="url" class="input form-control" name="inputUrl"
                                        placeholder="Enter a valid URL" required>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Digit</label>
                                <div>
                                    <input type="url" class="input form-control" name="inputDigit"
                                        placeholder="Enter a Digit" required>
                                </div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit">
                                        Submit
                                    </button>
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
        $(document).ready(function(){
            $('#addExpertiseBtn').on('click', function(e){
                e.preventDefault();

                $('#expertiseList').append(
                    `
                        <div class="input-group mb-4 expertise-item">
                            <input class="input expertise" type="text" name="expertise[]" placeholder="e.g Expert in Robotic Surgery">
                            <button class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white removeExpertiseBtn"> - Remove </button>
                        </div>
                    `
                )
            });

            $(document).on("click", ".removeExpertiseBtn", function () {
                $(this).parent(".expertise-item").remove();
            });
            
        });
    </script>
@endsection
