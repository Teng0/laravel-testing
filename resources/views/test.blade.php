<!DOCTYPE html>
<html>
<head>
    <title>Simple Login System in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
            border:1px solid #ccc;
        }
    </style>
</head>
<body>
<br />
<div class="container box">
    <h3 align="center">Simple Login System in Laravel</h3><br />


    @if(isset(Auth::user()->email))
        <script>window.location="/main/successlogin";</script>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if(count($errors)>0)


            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>

    @endif




    <form method="post"  action="{{url("main/checklogin")}}">
        {{csrf_field()}}
        <div class="form-group">
            <span id="error_email"></span>
            <label>Enter Email</label>
            <input type="email" name="email" id="email" class="form-control" />
        </div>
        <div class="form-group">
            <label>Enter Password</label>
            <input type="password" name="password" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="login" id="login" class="btn btn-primary" value="Login" />
        </div>
    </form>

    {{ csrf_field() }}
</div>
</body>
</html>

<script >

    $(document).ready(function () {
        $("#email").blur(function () {
            var error_email ="";
            var email = $("#email").val();
            var _token =$("input[name='_token']").val();
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!filter.test(email)){

                $('#error_email').html('<label class="text-danger">Invalid Email</label>');
                $('#email').addClass('has-error');
                $('#login').attr('disabled', 'disabled');

            }else{
                $.ajax({
                    url:"{{route('MainController.emailAvailable')}}",
                    method:"post",
                    data:{email:email,_token:_token},
                    success:function (result) {

                        if(result == 'right')
                        {
                            $('#error_email').html('<label class="text-success">Right Login</label>');
                            $('#email').removeClass('has-error');
                            $('#login').attr('disabled', false);
                        }
                        else
                        {
                            $('#error_email').html('<label class="text-danger">Email not Available</label>');
                            $('#email').addClass('has-error');
                            $('#login').attr('disabled', 'disabled');
                        }

                    }
                })
            }

        })

    })

</script>
