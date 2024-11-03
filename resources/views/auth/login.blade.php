@include('components.auth-header')




<body>

    

    {{-- logo section --}}
    <section class="logo-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-2 text-center">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset(logo()) }}" alt="{{ env('APP_NAME') }}" class="light-logo img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
   
    <div class="form-modal">

        <div class="form-toggle">
          <button id="login-toggle" onclick="toggleLogin()">log in</button>
          <button id="signup-toggle" onclick="toggleSignup()">sign up</button>
        </div>
      
        <div id="login-form">
            <form action="{{ route('login') }}" method="post">
                @csrf
            
               
                <input type="text" name="email" placeholder="Enter email or username" value="{{ old('email') }}" />
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            
               
                <input type="password" name="password" placeholder="Enter password" />
                @if ($errors->has('password'))
                    <div class="text-danger">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            
                
                <button type="submit" class="btn login">login</button>
            
                <!-- Forgotten Account Link -->
                <p><a href="{{ route('password.request') }}">Forgotten account</a></p>
                <hr />
            </form>
            
        </div>
      
        <div id="signup-form">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="email" name="email" placeholder="Enter your email"  value="{{ old('email') }}" />
            @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Choose username" />
            @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
            <input type="password" name="password"   placeholder="Create password" />
            @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
            <input type="password" placeholder="Confirm password" name="password_confirmation" />

            <button type="submit" class="btn signup">create account</button>
            
            <hr />
      
          </form>
        </div>
      
      </div>

     
    
    


    <script>
        function toggleSignup() {
            document.getElementById("login-toggle").style.backgroundColor = "#fff";
            document.getElementById("login-toggle").style.color = "#222";
            document.getElementById("signup-toggle").style.backgroundColor = "#57b846";
            document.getElementById("signup-toggle").style.color = "#fff";
            document.getElementById("login-form").style.display = "none";
            document.getElementById("signup-form").style.display = "block";
        }

        function toggleLogin() {
            document.getElementById("login-toggle").style.backgroundColor = "#57B846";
            document.getElementById("login-toggle").style.color = "#fff";
            document.getElementById("signup-toggle").style.backgroundColor = "#fff";
            document.getElementById("signup-toggle").style.color = "#222";
            document.getElementById("signup-form").style.display = "none";
            document.getElementById("login-form").style.display = "block";
        }
    </script>

</body>
