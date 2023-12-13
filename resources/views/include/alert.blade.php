@if (session()->has('alert'))
    <div x-data="{ show : true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
         class="alert alert-info alert-box" id="alert">
            <span class="fw-bold fs-5">
                <i class="fa fa-info-circle"></i>
                {{ session('alert') }}
            </span>
    </div>
    <script>
        setTimeout(function () {
            document.getElementById('alert').remove();
        }, 4000)
    </script>
@endif
