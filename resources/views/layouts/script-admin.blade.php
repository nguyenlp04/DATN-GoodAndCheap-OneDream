@if (session('alert'))
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    new DataTable('#example');
</script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "{{ session('alert')['type'] }}",
        title: "{{ session('alert')['message'] }}"
    });
</script>
@endif
<script>
    function confirmDelete(event, staffID) {
        event.preventDefault();
        Swal.fire({
            title: "Bạn chắc chứ?",
            text: "Nếu đồng ý sẽ không thể khôi phục! - Các sản phẩm thuộc danh mục này cũng sẽ bị xoá!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                document.getElementById(`delete-form-${staffID}`).submit();
            }
        });
    }
</script>