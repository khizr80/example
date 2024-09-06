<x-bases>
@section('content')

<div class="wrapper">
   <div class="title">
          Login Form
       </div>
       <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="field">
             <input type="email" name="username" required>
             <label>Email Address</label>
            </div>
          <div class="field">
             <input type="password" name="password" required>
             <label>Password</label>
            </div>
          <div class="field">
             <input type="submit" value="Login">
          </div>
          <div class="signup-link">
             Not a member? <a href="{{ url('/signup') }}">Signup now</a>
            </div>
         </form>
         
         @if ($errors->any())
         <div class="error-messages">
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
       @endif
      </div>
      <x-message>
         
         </x-message>
         @endsection
      </x-bases>
