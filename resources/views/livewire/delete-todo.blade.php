<div class="ConfirmDeleteTodo" id="ConfirmDeleteTodo" style="display: none">
    <div class="card-header bg-danger box-shadow">
        <h6 class="text-white text-shadow">آیا مایل به حذف این وظیفه هستید؟</h6>
    </div>
    <div class="card-body">
        <p class="fs14">این عمل غیر قابل بازگشت است و درصورت حذف این وظیفه
            <strong> تمامی نظرات</strong>
            مرتبط با این وظیفه نیز
            <strong>حذف</strong>
            خواهد شد.
        </p>
        <a class="btn btn-danger text-white text-shadow box-shadow"
           wire:click="remove" style="float: left">بله، حذف شود</a>
        <a class="btn btn-success text-white text-shadow box-shadow"
           style="float: right" onclick="closeConfirmDeleteTodo()">خیر، حذف نشود
        </a>
    </div>

    <script>
        function openConfirmDeleteTodo() {
            document.getElementById('ConfirmDeleteTodo').style.display = 'block';
        }

        function closeConfirmDeleteTodo() {
            document.getElementById('ConfirmDeleteTodo').style.display = 'none';
        }
    </script>
</div>
