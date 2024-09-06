<x-bases>
    @section('content')

    <body>

        <div class="wrapper">
            <div class="title">Add User</div>
            <form action="{{route('signupController')}}" method="post">
                @csrf

                <div class="field">
                    <input type="text" name="name" required>
                    <label>Name</label>
                </div>
                <div class="field">
                    <input type="email" name="username" required>
                    <label>Email</label>
                </div>
                <div class="field">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="field">
                    <input type="text" name="role" required>
                    <label>Role</label>
                </div>
                <div class="field">
                    <input type="hidden" name="action" value="adduser">
                    <input type="submit" value="Sign Up">
                </div>
            </form>
        </div>
    </body>
    @endsection
</x-bases>