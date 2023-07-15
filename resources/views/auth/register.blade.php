<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
</head>
<body>
    <section>
        <div class="row">
            <div class="container">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header" style="text-align: center">Register</div>
                            <div class="card-body">
                                <form action="{{ route('auth.register.store')}}" method="POST">
                                    @csrf
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Password">
                                    <label for="confirm">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
                                    <label for="type">Account Type</label>
                                    <select name="type" id="type">
                                        <option value="individual">Individual</option>
                                        <option value="businesss">Business</option>
                                    </select>
                                    <input type="submit" value="Register">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>