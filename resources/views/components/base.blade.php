<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"> -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
  <div id="toast-container" class="fixed bottom-5 right-5 z-50"></div>

  <main>
    @yield('content')
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

  <script>
    // Function to show toast messages
    function showToast(message, type) {
      const toastTypes = {
        success: 'toast-success',
        danger: 'toast-danger',
      };

      const toast = document.createElement('div');
      toast.classList.add('flex', 'items-center', 'w-full', 'max-w-xs', 'p-4', 'mb-4', 'text-gray-500', 'bg-white', 'rounded-lg', 'shadow', 'dark:text-gray-400', 'dark:bg-gray-800', 'role', 'alert');

      let toastIcon, toastText, bgColor, iconColor;

      switch(type) {
        case 'success':
          toastIcon = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>';
          toastText = message || 'Item moved successfully.';
          bgColor = 'bg-green-100';
          iconColor = 'text-green-500';
          break;
        case 'error':
          toastIcon = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/></svg>';
          toastText = message || 'Item has been deleted.';
          bgColor = 'bg-red-100';
          iconColor = 'text-red-500';
          break;
      }

      toast.innerHTML = `
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 ${iconColor} ${bgColor} rounded-lg dark:bg-gray-800 dark:text-gray-200">
          ${toastIcon}
        </div>
        <div class="ms-3 text-sm font-normal">${toastText}</div>
      `;

      const toastContainer = document.getElementById('toast-container');
      toastContainer.appendChild(toast);

      setTimeout(() => {
        toast.remove();
      }, 3000);
    }

  </script>
</body>
</html>
