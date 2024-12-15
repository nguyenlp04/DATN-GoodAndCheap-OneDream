 
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    new DataTable('#example');
</script>
    @if (session('alert'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
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
      
 $(document).ready(function() {
     // Khôi phục trạng thái tab từ localStorage
     var activeTab = localStorage.getItem('activeTab');
   
     
     if (activeTab) {
         $('a[data-bs-toggle="tab"][href="' + activeTab + '"]').tab('show');
     } else {
         $('#tab-all').tab('show');
     }

     $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
         var targetTab = $(e.target).attr("href");
        
         localStorage.setItem('activeTab', targetTab);
     });
 });

</script>

<script>
    function confirmDelete(event, articleId) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${articleId}`).submit();
            } else {
                Swal.fire({
                    title: "Cancelled!",
                    text: "Action cancelled. Item was not deleted.",
                    icon: "error"
                });
            }
        });
    }
</script>
