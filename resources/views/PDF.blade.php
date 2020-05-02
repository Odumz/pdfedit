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
                                        <input class="form-control" name="fullName" id="fullName" placeholder="Enter a job title" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Duration</label>
                                        <input class="form-control" name="duration" placeholder="Enter the necessary description" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Start Date</label>
                                        <input class="form-control" name="startDate" id="startDate" placeholder="Enter the responsibilities" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Scope</label>
                                        <input class="form-control" name="scope" id="scope" placeholder="Enter a job title" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Binding</label>
                                        <input class="form-control" name="binding" placeholder="Enter the necessary description" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Duration from</label>
                                        <input class="form-control" name="durationFrom" id="durationFrom" placeholder="Enter the responsibilities" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Duration to</label>
                                        <input class="form-control" name="durationTo" id="durationTo" placeholder="Enter a job title" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Cost</label>
                                        <input class="form-control" name="cost" placeholder="Enter the necessary description" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Per</label>
                                        <input class="form-control" name="per" id="per" placeholder="Enter the responsibilities" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Total</label>
                                        <input class="form-control" name="total" id="total" placeholder="Enter a job title" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Payment Due:</label>
                                        <input class="form-control" name="paymentDue" placeholder="Enter the necessary description" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Payment to:</label>
                                        <input class="form-control" name="paymentTo" id="paymentTo" placeholder="Enter the responsibilities" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Availability Time</label>
                                        <input class="form-control" name="availabilityTime" id="availabilityTime" placeholder="Enter a job title" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Approval Date</label>
                                        <input type="date" class="form-control" name="approvalDate" placeholder="Enter the necessary description" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Client Name</label>
                                        <input class="form-control" name="clientName" placeholder="Enter the necessary description" required/>
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

                </div>
            </div>
        </div>
    </body>
</html>
