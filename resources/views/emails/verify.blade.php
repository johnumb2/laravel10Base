<!DOCTYPE html>
<html>
<head>
    <title>Account Verification</title>
</head>
<body>
    <h2>Welcome to our website, {{ $email }}</h2>
    <br/>
        Your account has been created, please click the link below to verify your email address.
    <br/>
    <a href="{{ url('verify-email', $hashcode) }}">Verify Email</a>
</body>
</html>
