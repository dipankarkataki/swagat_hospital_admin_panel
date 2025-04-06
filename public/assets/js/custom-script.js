
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
    

});
