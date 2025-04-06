@if(Session::has('success'))
    <div class="toast-position">
        <div class="toast fade show" id="notificationToastSuccess">
            <div class="notification">
                <div class="notification-content">
                    <div class="mr-3">
                        <span class="text-2xl text-emerald-400">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="mr-4">
                        <div class="notification-title">Success</div>
                        <div class="notification-description">
                            {{ Session::get('success') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(Session::has('exception'))
    <div class="toast-position">
        <div class="toast fade show" id="notificationToastError">
            <div class="notification">
                <div class="notification-content">
                    <div class="mr-3">
                        <span class="text-2xl text-red-400">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="mr-4">
                        <div class="notification-title">Error</div>
                        <div class="notification-description">
                            {{ Session::get('exception') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif