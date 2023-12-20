@if (session()->has('alert'))
    <div x-data x-init="setTimeout(()=> {$el.remove()},4000)"
         class="alert alert-info alert-box" id="alert">
        <span class="fw-bold fs-5">{{ session('alert') }}</span>
    </div>
    <script>
        let alert = document.getElementById('alert');
        setTimeout(() => { alert.remove()}, 4000);
    </script>
@endif