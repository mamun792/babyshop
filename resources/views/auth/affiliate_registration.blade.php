<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Affiliate Sign Up</title>
  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="{{asset('assets/fontend/css/bootstrap.min.css')}}">
  <!-- Optional custom CSS for additional styling -->
  <link rel="stylesheet" href="css/signin.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded">
          <div class="card-header bg-primary text-white text-center">
            <h4>Affiliate Registration</h4>
          </div>

          <div class="card-body p-4">
            <!-- Display validation errors -->
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <!-- Affiliate registration form -->
            <form action="{{ route('affiliate.register') }}" method="POST">
              @csrf
              <!-- Name field -->
              <div class="form-group mb-3">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
              </div>

              <!-- Email field -->
              <div class="form-group mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
              </div>

              <!-- Password field -->
              <div class="form-group mb-3">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
              

              <!-- Phone field -->
              <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
              </div>

              <!-- Address field -->
              <div class="form-group mb-3">
                <label for="address">Address</label>
                <textarea id="address" name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
              </div>

              <!-- Promotion Ouroase field -->
              <div class="form-group mb-3">
                <label for="promotion_ouroase">Promotion Ouroase</label>
                <input type="text" id="promotion_ouroase" name="promotion_ouroase" class="form-control" value="{{ old('promotion_ouroase') }}">
              </div>

              <!-- Balance field -->
              

              {{-- <!-- Refer Code field -->
              <div class="form-group mb-3">
                <label for="refer_code">Refer Code <span class="text-danger">*</span></label>
                <input type="text" id="refer_code" name="refer_code" class="form-control" value="{{ old('refer_code') }}" required>
              </div> --}}

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
