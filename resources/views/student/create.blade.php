@extends("master")

@section("content")

    <div class="row">

        <br />
        <h3 align="center">Add Data</h3>
        <br />

        @if (count($errors)>0)

            <div class="allert  alert-danger">

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach

                </ul>

            </div>


        @endif

        @if (\Illuminate\Support\Facades\Session::has('success'))

            <div class="allert  alert-success">

               <p>{{\Illuminate\Support\Facades\Session::get("success")}}</p>

            </div>


        @endif

        <form action="{{url('student')}}" method="POST">
            {{csrf_field()}}
                <div class="form-group">

                    <input type="text" name="first_name" class="form-control" placeholder="Enter First_name">
                </div>
            <div class="form-group">

                <input type="text" name="last_name" class="form-control" placeholder="Enter last_name">
            </div>
            <div class="form-group">

                <input type="submit" class="btn btn-primary">
            </div>
        </form>

    </div>

@endsection
