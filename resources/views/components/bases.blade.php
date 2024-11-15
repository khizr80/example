<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js" defer></script>

</head>
<body>

<main>
    @yield('content') <!-- This is where the content section from extending views will be inserted -->
</main>  
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

</body>
</html>
