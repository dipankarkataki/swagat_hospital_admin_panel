
$(document).ready(function(){

    //Show Toast Notification From Tailwind CSS
    const toastSuccess = $("#notificationToastSuccess");
    const toastError = $("#notificationToastError");
    
    if (toastSuccess.length) {
        toastSuccess.fadeIn().delay(3000).fadeOut();
    }
    if (toastError.length) {
        toastError.fadeIn().delay(3000).fadeOut();
    }

    //Add More Functionality For Expertise
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


    //Add More Functionality For Memberships
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


    //Add More Functionality For Research And Publication
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


    //Add More Functionality For Awards
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

    
    //Add More Functionality For Available Date And Time
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


    // Preview Photo Before Upload
    $('#uploadProfilePicture').on('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $('#uploadImgSvg').attr('src', event.target.result).hide();
            $('#imagePreview').attr('src', event.target.result).show();
        };
        reader.readAsDataURL(this.files[0]);
    });

    //Dynamic form submit button
    $(document).on('submit', 'form', function(e){
        const submitBtn = $(this).find('button[type="submit"]');
        if (submitBtn.length) {
            submitBtn.attr('disabled', true).text('Please wait...');
        }
    });

    $('#createPortfolioForm').on('submit', function(){
        $('#submitPortfolioBtn').attr('disabled', true).text('Please wait...');
    });

    //Disable delete button on click
    $('.deleteButton').on('click', function(e) {
        e.preventDefault();
        const deleteButton = $(this);
        const deleteUrl = deleteButton.attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            preConfirm: () => {
                const confirmBtn = Swal.getConfirmButton();
                confirmBtn.disabled = true;
                confirmBtn.innerHTML = 'Deleting...';
    
                return new Promise((resolve) => {
                    setTimeout(() => {
                        // Redirect after delay
                        window.location.href = deleteUrl;
                        resolve(); // closes the swal after redirection
                    }, 1000);
                });
            }
        })
    });


    //Update Account Status
    $('.update-account-status').on('click', function(){
        const button_text = $(this).text();
        $(this).attr('disabled', true).text('Please wait...');
        const status = $(this).data('status');
        const portfolio_id = $(this).data('id');
        const update_url = $(this).data('url');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: update_url,
            type:"POST",
            data:{
                'status': status,
                'id': portfolio_id,
            },
            success:function(response){
                if(response.success === true){
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();  
                    }, 1000);
                }
            },error:function(xhr, status, error){
                if(xhr){
                    toastr.error('Oops! Something went wrong. Please try again.');
                }
            },complete:function(){
                $(this).attr('disabled', false).text(button_text);
            }
        });
    });
    

});
