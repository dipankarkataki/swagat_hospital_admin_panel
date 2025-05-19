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
                    <form id="createPortfolioForm" method="POST" action="{{ route('portfolio.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-container">
                            <div class="form-item">
                                <div class="grid xl:grid-cols-3">
                                    <div class="col-span-1 form-item vertical">
                                        <label class="form-label mb-2">Profile Picture *</label>
                                        <div class="upload upload-draggable hover:border-primary-600 cursor-pointer h-[300px]" @error('uploadProfilePicture') style="border: 2px dashed rgb(239 68 68)" @enderror>
                                            <div>
                                                <input class="upload-input draggable" id="uploadProfilePicture" name="uploadProfilePicture" type="file">
                                            </div>
                                            <div class="text-center">
                                                <svg id="uploadImgSvg" class="mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                                <div class="flex flex-row justify-center items-center">
                                                    <img id="imagePreview" src="" alt="Image Preview" style="display:none; max-width: 150px; margin-top: 10px; margin-bottom:10px; border-radius: 5px;">
                                                </div>
                                                <p class="font-semibold">
                                                    <span class="text-gray-800 dark:text-white">Drop your image here, or</span>
                                                    <span class="text-blue-500">browse</span>
                                                </p>
                                                <p class="mt-1 opacity-60 dark:text-white">Support: jpeg, png</p>
                                            </div>
                                        </div>
                                        @error('uploadProfilePicture')
                                            <div class="text-red-500 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Full Name *</label>
                                <div>
                                    <input type="text" class="input form-control @error('fullName') input-invalid @enderror" name="fullName" placeholder="e.g Jhon Doe" value="{{ old('fullName') }}">
                                </div>
                                @error('fullName')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Enter Official Email Id *</label>
                                <div>
                                    <input type="email" class="input form-control @error('email') input-invalid @enderror" name="email" placeholder="e.g jhondoe@example.com" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Qualification *</label>
                                <div>
                                    <textarea class="input input-textarea @error('qualification') input-invalid @enderror" name="qualification" placeholder="Enter qualifications of the doctor. e.g MBBS, FRCS, etc."  >{{ old('qualification') }}</textarea>
                                </div>
                                @error('qualification')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Choose Years of Experience *</label>
                                <div>
                                    <select class="input @error('yearsOfExperience') invalid-div @enderror" name="yearsOfExperience">
                                        <option value="">Choose years</option>
                                        @for ($i = 1; $i <= 60; $i++)
                                            <option value="{{ $i }}" {{ old('yearsOfExperience') == $i ? 'selected' : '' }}>
                                                Years of Experience : {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('yearsOfExperience')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Choose Linked Department *</label>
                                <div>

                                    <select class="input @error('department_id') invalid-div @enderror" name="department_id">
                                        <option value="">Choose department</option>

                                        @foreach ($list_of_departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('department_id')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Languages Speak</label>
                                <div>
                                    <input type="text" class="input form-control @error('languagesSpeak') input-invalid @enderror" name="languagesSpeak" placeholder="Enter languages separated by comma(,)" value="{{ old('languagesSpeak') }}">
                                </div>
                                @error('languagesSpeak')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Brief Description *</label>
                                <div>
                                    <textarea class="input input-textarea @error('briefDescription') input-invalid @enderror" name="briefDescription" placeholder="Write a brief description about the doctor, his work etc."  >{{ old('briefDescription') }}</textarea>
                                </div>
                                @error('briefDescription')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Add Expertise</label>
                                <div>
                                    <div class="input-group mb-4">
                                        @php $expertises = old('expertise', []); @endphp
                                        <input class="input expertise @error('expertise') input-invalid @enderror" type="text" name="expertise[]" placeholder="e.g Expert in Robotic Surgery" value="{{ $expertises[0] ?? '' }}">
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
                                    @foreach(array_slice($expertises, 1) as $expertise)
                                        <div class="input-group mb-4 expertise-item">
                                            <input class="input expertise" type="text" name="expertise[]" placeholder="e.g Expert in Robotic Surgery"
                                                value="{{ $expertise }}">
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
                                    @endforeach
                                    <div id="expertiseList"></div>
                                </div>
                                @error('expertise')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Add Membership</label>
                                <div>
                                    <div class="input-group mb-4">
                                        @php $memberships = old('membership', []); @endphp
                                        <input class="input membership @error('membership') input-invalid @enderror" type="text" name="membership[]" placeholder="e.g Member of Nephrology Association of Karnataka" value="{{ $memberships[0] ?? '' }}">
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
                                    @foreach(array_slice($memberships, 1) as $membership)
                                        <div class="input-group mb-4 membership-item">
                                            <input class="input membership" type="text" name="membership[]" placeholder="e.g Member of Nephrology Association of Karnataka" value="{{ $membership }}">
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
                                    @endforeach
                                    <div id="membershipList"></div>
                                    @error('membership')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Add Research And Publications</label>
                                <div>
                                    <div class="input-group mb-4">
                                        @php $researches = old('research', []); @endphp
                                        <input class="input research @error('research') input-invalid @enderror" type="text" name="research[]" placeholder="e.g Collagen type III diseases – case reports – IJPM – March 2016" value="{{ $researches[0] ?? '' }}">
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
                                    @foreach(array_slice($researches, 1) as $research)
                                        <div class="input-group mb-4 research-item">
                                            <input class="input research" type="text" name="research[]" placeholder="e.g Collagen type III diseases – case reports – IJPM – March 2016" value="{{ $research }}">
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
                                    @endforeach
                                    <div id="researchList"></div>
                                    @error('research')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Add Awards And Achievements</label>
                                <div>
                                    <div class="input-group mb-4">
                                        @php $awards = old('awards', []); @endphp
                                        <input class="input awards @error('awards') input-invalid @enderror" type="text" name="awards[]" placeholder="e.g Best Surgeon Award" value={{ $awards[0] ?? '' }}>
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
                                    @foreach(array_slice($awards, 1) as $award)
                                        <div class="input-group mb-4 awards-item">
                                            <input class="input awards" type="text" name="awards[]" placeholder="e.g Collagen type III diseases – case reports – IJPM – March 2016" value={{ $award }}>
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
                                    @endforeach
                                    <div id="awardsList"></div>
                                    @error('awards')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD Date</label>
                                <div>
                                    <div class="input-group mb-4">
                                        @php $opdDates = old('opdDate', []); @endphp
                                        <input class="input opdDate @error('opdDate') input-invalid @enderror" type="date" name="opdDate[]" value={{ $opdDates[0] ?? '' }}>
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
                                    @foreach(array_slice($opdDates, 1) as $opdDate)
                                        <div class="input-group mb-4 available-date-item">
                                            <input class="input opdDate" type="datetime-local" name="opdDate[]" value={{ $opdDate }}>
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
                                    <div id="availableDateTimeList"></div>
                                    @error('opdDate')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-item">
                                <label class="form-label mb-2">Set Available Date And Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        @php $availableDates = old('availableDate', []); @endphp
                                        <input class="input availableDate @error('availableDate') input-invalid @enderror" type="datetime-local" name="availableDate[]" value={{ $availableDates[0] ?? '' }}>
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
                                    @foreach(array_slice($availableDates, 1) as $availableDate)
                                        <div class="input-group mb-4 available-date-item">
                                            <input class="input availableDate" type="datetime-local" name="availableDate[]" value={{ $availableDate }}>
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
                                    <div id="availableDateTimeList"></div>
                                    @error('availableDate')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-item">
                                <label class="form-label mb-2">Set OPD Start Time</label>
                                <div>
                                    <div class="input-group mb-4">
                                        <input class="input opdStartTime @error('opdStartTime') input-invalid @enderror" type="time" name="opdStartTime" value={{ old('opdStartTIme')}}>
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
                                        <input class="input opdEndTime @error('opdEndTime') input-invalid @enderror" type="time" name="opdEndTime" value={{ old('opdEndTime')}}>
                                    </div>
                                    @error('opdEndTime')
                                        <div class="text-red-500 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label mb-2">Assign Hospital *</label>
                                <div>
                                    <select class="input @error('hospital_id') invalid-div @enderror" name="hospital_id">
                                        <option value="">Choose hospital</option>
                                        @foreach ($list_of_hospitals as $item)
                                            <option value="{{ $item->id }}" {{ old('hospital_id') ==  $item->id  ? 'selected' : ''}}>{{ $item->name }} : {{ $item->address }}</option>
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
