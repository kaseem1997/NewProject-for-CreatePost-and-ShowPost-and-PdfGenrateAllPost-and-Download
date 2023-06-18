<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" name="mobile" id="mobile" required>
            </div>
            <div class="form-group">
                <label for="otp">OTP:</label>
                <input type="password" name="otp" id="otp" required>
            </div>
            @if ($errors->any())
                <div class="error">{{ $errors->first('error') }}</div>
            @endif
            <button type="submit">Login</button>
        </form>
        <p><strong>Note:-</strong> Please login mobile No :- 1234567890</p>
        <p><strong>Note:-</strong> Please login Password :- 123456</p>
    </div>
</body>
</html>
