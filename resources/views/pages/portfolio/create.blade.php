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
                    <form id="createPortfolioForm">
                        <div class="form-container">
                            <div class="form-item">
                                <div class="grid xl:grid-cols-3">
                                    <div class="col-span-1 form-item vertical">
                                        <label class="form-label mb-2">Profile Picture *</label>
                                        <div
                                            class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]">
                                            <div>
                                                <input class="upload-input draggable" name="uploadProfilePicture" type="file" required>
                                            </div>
                                            <div class="text-center">
                                                <svg class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
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
                                    <div class="col-span-2 flex md:justify-end">
                                        <button class="btn bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600 text-white">
                                            Accepting Appointments
                                        </button>
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
                                    <input type="text" class="input form-control" name="languagesSpeak" placeholder="Enter languages separated by comma(,)">
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
                                        <button class="btn btn-solid" id="addExpertiseBtn">
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
                                    <div id="expertiseList"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Add Membership</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input membership" type="text" name="membership[]" placeholder="e.g Member of Nephrology Association of Karnataka">
                                        <button class="btn btn-solid" id="addMembershipBtn">
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
                                    <div id="membershipList"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Add Research And Publications</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input research" type="text" name="research[]" placeholder="e.g Collagen type III diseases – case reports – IJPM – March 2016">
                                        <button class="btn btn-solid" id="addResearchBtn">
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
                                    <div id="researchList"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Add Awards And Achievements</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input awards" type="text" name="awards[]" placeholder="e.g Best Surgeon Award">
                                        <button class="btn btn-solid" id="addAwardsBtn">
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
                                    <div id="awardsList"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set Available Date And Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input availableDate" type="datetime-local" name="availableDate[]">
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
                                    <div id="availableDateTimeList"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Assign Hospital *</label>
                                <div>
                                    <select class="input" name="hospital" required>
                                        <option selected>Choose hospital</option>
                                        <option value="gynacology">Gate No 3, Maligaon</option>
                                        <option value="medicine">Santipur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-item"><label class="form-label"></label>
                                <div>
                                    <button class="btn btn-default" type="submit"> Submit </button>
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
            $('#addExpertiseBtn').on('click', function(e) {
                e.preventDefault();

                $('#expertiseList').append(
                    `
                        <div class="input-group mb-4 expertise-item">
                            <input class="input expertise" type="text" name="expertise[]" placeholder="e.g Expert in Robotic Surgery">
                            <button class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white removeExpertiseBtn">
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
                    `
                )
            });

            $(document).on("click", ".removeExpertiseBtn", function() {
                $(this).parent(".expertise-item").remove();
            });

        });

        $(document).ready(function() {
            $('#addMembershipBtn').on('click', function(e) {
                e.preventDefault();

                $('#membershipList').append(
                    `
                        <div class="input-group mb-4 membership-item">
                            <input class="input membership" type="text" name="membership[]" placeholder="e.g Member of Nephrology Association of Karnataka">
                            <button class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white removeMembershipBtn">
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
                    `
                )
            });

            $(document).on("click", ".removeMembershipBtn", function() {
                $(this).parent(".membership-item").remove();
            });

        });

        $(document).ready(function() {
            $('#addResearchBtn').on('click', function(e) {
                e.preventDefault();

                $('#researchList').append(
                    `
                        <div class="input-group mb-4 research-item">
                            <input class="input research" type="text" name="research[]" placeholder="e.g Collagen type III diseases – case reports – IJPM – March 2016">
                            <button class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white removeResearchBtn">
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
                    `
                )
            });

            $(document).on("click", ".removeResearchBtn", function() {
                $(this).parent(".research-item").remove();
            });

        });

        $(document).ready(function() {
            $('#addAwardsBtn').on('click', function(e) {
                e.preventDefault();

                $('#awardsList').append(
                    `
                        <div class="input-group mb-4 awards-item">
                            <input class="input awards" type="text" name="awards[]" placeholder="e.g Collagen type III diseases – case reports – IJPM – March 2016">
                            <button class="btn bg-rose-600 hover:bg-rose-500 active:bg-rose-700 text-white removeAwardsBtn">
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
                    `
                )
            });

            $(document).on("click", ".removeAwardsBtn", function() {
                $(this).parent(".awards-item").remove();
            });

        });

        $(document).ready(function() {
            $('#addAvailableDateBtn').on('click', function(e) {
                e.preventDefault();

                $('#availableDateTimeList').append(
                    `
                        <div class="input-group mb-4 available-date-item">
                            <input class="input availableDate" type="datetime-local" name="availableDate[]">
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
                    `
                )
            });

            $(document).on("click", ".removeAvailableDateTimeBtn", function() {
                $(this).parent(".available-date-item").remove();
            });

        });
    </script>
@endsection
