<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD Application</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- js aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- MDB -->
    <!-- Font Awesome -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet"/> --}}
    {{-- fonts --}}
    <link href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    {{-- css --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>

    @auth
     <h1 class="welcome">Welcome to home page!</h1>

     <div class="post-btn">
        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus me-2"></i>Create new post</button>
     </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Post Title and Content</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="/create-post" method="POST">
                @csrf
                <input type="text" class="form-control" name="title" placeholder="Enter Title">
                <textarea class="form-control mt-3 mb-3" id="exampleFormControlTextarea1" rows="5" name="body" placeholder="Enter Content"></textarea>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save Post</button>
                </div>
                
                {{-- <div class="form-group">
                    
                    
                </div> --}}
              </form>
            </div>
            
            </div>
        </div>
    </div>

    {{-- <div class="container mt-5">
        @foreach ($users as $user)
            @if ($user['id'] == $post['user_id'])
                <p>{{ $user['name'] }}</p>
            @endif
        @endforeach
    </div> --}}

    <div class="m-5">
        <h2>All Posts</h2>
        @foreach ($posts as $post)
            <div class="m-3 rounded-pill" style="background: white">
                <h3 class="ms-5 pt-3 caption">{{ $post['title'] }}</h3>
                @foreach ($users as $user)
                    @if ($user['id'] == $post['user_id'])
                        <p class="ms-5">Author - {{ $user['name'] }}</p>                        
                    @endif
                @endforeach
                <hr style="width: 90%; margin-left: 5vh;">
                <p class="ms-5 content">{{ $post['body'] }}</p>

                <div class="ms-5 btn-toolbar pb-3">
                    <p><a href="/edit-post/{{ $post->id }}" class="btn btn-success me-3 mt-3">Edit</a></p>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mt-3">Delete</button>
                    </form>
                </div>
                
                
            </div>
        @endforeach
    </div>


     <form action="/logout" method="POST">
        @csrf
        <div class="d-flex justify-content-end me-5 pe-5 mb-5">
            <button class="btn btn-dark">Log Out</button>
        </div>
        
     </form>
    @else 
        <div class="main">

            <!-- Register form -->
            <section class="signup">
                <div class="container">
                    <div class="signup-content">
                        <div class="signup-form">
                            <h2 class="form-title">Register</h2>
                            <form action="/register" method="POST" class="register-form" id="register-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="name" id="name" placeholder="Your Name"/>
                                </div>
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                                    <input type="email" name="email" id="email" placeholder="Your Email"/>
                                </div>
                                <div class="form-group">
                                    <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="pass" placeholder="Password"/>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                                </div>
                            </form>
                        </div>
                        <div class="signup-image">
                            <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Log in  Form -->
            <section class="sign-in">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                            <a href="#" class="signup-image-link">Create an account</a>
                        </div>

                        <div class="signin-form">
                            <h2 class="form-title">Log In</h2>
                            <form action="/login" method="POST" class="register-form" id="login-form">
                                @csrf
                                <div class="form-group">
                                    <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="your_name" id="your_name" placeholder="Your Name"/>
                                </div>
                                <div class="form-group">
                                    <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>
                                </div>
                                {{-- <div class="form-group">
                                    <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                    <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                                </div> --}}
                                <div class="form-group form-button">
                                    <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                                </div>
                            </form>
                            <div class="social-login">
                                <span class="social-label">Or login with</span>
                                <ul class="socials">
                                    <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    @endauth


    

      <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script> --}}

    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>