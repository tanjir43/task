<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
</head>
<body>
    
                <div style="text-align: center">Login</div>
                    <div>
                        <form action="{{ route('auth.login.store')}}" method="POST">
                            @csrf
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password">
                            <input type="submit" value="Login">
                        </form>
                    </div>
                </div>
          
</body>
</html>