<!-- <x-base>
    <div class="container mx-auto p-4">
        <form id="convertForm" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Upload DOCX File</label>
                <input type="file" name="document" accept=".docx" class="mt-1 block w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Convert to Markdown
            </button>
        </form>

        <div id="result" class="mt-8">
            <pre class="bg-gray-100 p-4 rounded hidden"></pre>
        </div>
    </div>

    @push('scripts')
    <script>
        $('#convertForm').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: "{{ route('convert.document') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#result pre')
                            .text(response.markdown)
                            .removeClass('hidden');
                    }
                },
                error: function(xhr) {
                    alert('Error converting document: ' + xhr.responseJSON.message);
                }
            });
        });
    </script>
    @endpush
</x-base> -->


<x-base>
    @section('content')
    @include('partials.navAdmin');

    <body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-4">
        <form id="convertForm" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Upload DOCX File</label>
                <input type="file" name="document" accept=".docx" class="mt-1 block w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Convert to Markdown
            </button>
        </form>

        <div id="result" class="mt-8">
            <pre class="bg-gray-100 p-4 rounded hidden"></pre>
        </div>
    </div>

    </body>
    <script>
        $('#convertForm').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: "{{ route('convert.document') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#result pre')
                            .text(response.markdown)
                            .removeClass('hidden');
                    }
                },
                error: function(xhr) {
                    alert('Error converting document: ' + xhr.responseJSON.message);
                }
            });
        });
    </script>
    @endsection
</x-base>

