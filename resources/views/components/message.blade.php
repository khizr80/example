@if (session('status'))
    <script>
        Swal.fire({
            title: "{{ session('status') == 'success' ? 'Success!' : 'Error!' }}",
            text: "{{ session('message') }}",
            icon: "{{ session('status') == 'success' ? 'success' : 'error' }}",
            confirmButtonText: 'OK'
        });
    </script>
@endif
