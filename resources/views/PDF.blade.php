<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit PDF</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Edit PDF
                </div>

                <div class="col-md-6 col-xl-8">
                <form method="post" action="{{ route('editPDF') }}" enctype="application/json">
                    {{ csrf_field() }}
                    <!-- fieldsets -->
                    <fieldset id="first">
                    <div class="card">
                        <div class="card-status bg-teal"></div>
                        <div class="card-header">
                            <h3 class="card-title">SLA Details</h3>
                            {{-- <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a> |||| action="http://localhost:8080/api/v1/recruit/recruitment"
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input class="form-control" name="fullName" id="fullName" placeholder="Enter a job title"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Duration</label>
                                        <textarea class="form-control" name="duration" rows="7" placeholder="Enter the necessary description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Start Date</label>
                                        <textarea class="form-control" name="startDate" id="startDate" placeholder="Enter the responsibilities"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </fieldset>

                    <fieldset id="fourth">
                        <div class="form-footer d-flex">
                            <button type="submit" class="btn btn-primary col-sm-2 ml-auto">Submit</button>
                        </div>
                    </fieldset>
                </form>
            <script>
                require(['input-mask']);
            </script>
        </div>

                <div class="links">
                    {{-- <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a> --}}

                    <a href="/editPDF">Start</a>

                </div>
            </div>
        </div>
    </body>
</html>
