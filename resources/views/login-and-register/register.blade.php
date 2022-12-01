<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pradita University's Guest Lecturers</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/style-form.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootsrap CSS Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!--  -->
</head>
<body>
    <section id="form">
        <div class ="form-spacer">
            <div class="container">
                <div class="form">
                    <i class="bi bi-info-circle info"></i>
                    <div class="logo">
                        <img src="./assets/img/logo-pradita.png" class="logo-pradita">
                    </div>

                    <h1 class="title">WELCOME BACK!</h1>

                    <div class="inner-form">
                        <form class="row g-3 needs-validation" action="{{ route('register.store') }}" method="POST">
                            @csrf
                            <div class="container">
                                <div class="input-group mb-3 has-validation ">
                                    <span class="input-group-text" id="inputEmail">@</span>
                                    <input type="email" class="form-control" placeholder="Email" id="validationCustomEmail" aria-describedby="inputEmail" required name='email'>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        Please write the valid email (ex: hello@gmail.com)
                                    </div>
                                    @enderror
                                </div>

                                <div class="input-group mb-3 has-validation">
                                    <span class="input-group-text" id="inputUsername"><i class="bi bi-person-circle"></i></span>
                                    <input type="text" class="form-control" placeholder="Username" id="validationCustomUsername" aria-describedby="inputUsername" required name='username'>
                                    @error('username')
                                    <div class="invalid-feedback">
                                        Please choose a valid username.
                                    </div>
                                    @enderror
                                </div>

                                <div class="input-group mb-3 has-validation">
                                    <span class="input-group-text" id="inputPassword"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Password" id="password-field" aria-describedby="inputPassword" required name="password1">
                                    @error('password1')
                                    <div class="invalid-feedback">
                                        Please input at least 8 characters.
                                    </div>
                                    @enderror
                                </div>

                                <div class="input-group mb-3 has-validation">
                                    <span class="input-group-text" id="confirmPassword"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Confirm Password" id="password-field" aria-describedby="confirmPassword" required name="password2">
                                    @error('password2')
                                    <div class="invalid-feedback">
                                        The password don't match!
                                    </div>
                                    @enderror
                                </div>


                                <p class="forgot-pass"><a href="#">Forgot Password?</a></p>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inlineFormCheck" required>
                                        <label class="form-check-label" for="inlineFormCheck">
                                            Remember me
                                        </label>
                                    </div>
                                </div>

                                <br>
                                <div class="col-12">
                                    <div class="d-grid gap-2">
                                        <button class="login" type="submit">REGISTER</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="another-page">
                        <p>Already have an account? <span><a href="{{ route("login.index") }}">Log In</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src ="./assets/js/script-form.js"></script>

</body>
</html>
