<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personal Blog</title>
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
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

</head>
<body>

    @auth
    <div class="colour">
        
     <h1 class="well">Welcome {{ Auth::user()->name }}!</h1>

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
            <div class="m-sm-3 m-1" style="background: white; border-radius: 40px;">
                <h3 class="ms-5 pt-3 caption">{{ $post['title'] }}</h3>
                @foreach ($users as $user)
                    @if ($user['id'] == $post['user_id'])
                        <h5 class="ms-5">Author - {{ $user['name'] }}</h5>
                        <p class="ms-5">Last updated: {{ $post['updated_at'] }}</p>
                        
                    @endif
                @endforeach
                <hr style="width: 90%; margin-left: 5vh;">
                <p class="ms-5 content text-justify text-wrap" style="width: 88%; text-align: justify;">{{ $post['body'] }}</p>

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
        <div class="image">
            <img src="{{ asset('images/welcome.jpg') }}" alt="welcome page">
        </div>
        <div class="text">
            <h1 class="wel">Welcome to Your Personal Blog</h1>
            <div class="mt-5">
                <a href="/sign-up" class="btn btn-success me-5 hover-shadow">Register</a>
                <a href="/sign-in" class="btn btn-dark hover-shadow">Log In</a>
            </div>

        </div>
    
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