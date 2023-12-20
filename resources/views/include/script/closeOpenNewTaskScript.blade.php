<script>
    function closeNewTask() {
        let closeNewTask = document.getElementById('closeNewTask');
        let closeBtn = document.getElementById('closeBtn');

        if (closeNewTask.style.display === 'block') {
            closeNewTask.style.display = "none";
            closeBtn.className = 'float-left btn-outline-success close-btn';
            closeBtn.innerHTML = 'بازکردن';
        } else {
            closeNewTask.style.display = "block";
            closeBtn.className = 'float-left btn-outline-danger close-btn';
            closeBtn.innerHTML = 'بستن';

        }
    }
</script>