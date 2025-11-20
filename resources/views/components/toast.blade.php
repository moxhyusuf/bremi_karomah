@if (session('message'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast-message" class="toast align-items-center text-white bg-{{ session('message.type') }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('message.text') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
