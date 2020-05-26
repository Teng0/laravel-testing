@extends("master")

@section("content")



    <div class="row">
        <div class="col-md-12">
            <br />
            <h3 align="center">Edit Record</h3>
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

            <form action="{{action('studentController@update', $id)}}" method="post">
                {{csrf_field()}}

                <input type="hidden" name="_method" value="patch">
                <div class="form-group">

                    <input type="text" name="first_name" class="form-control"  value="{{$student->first_name}}" placeholder="Enter First_name">
                </div>
                <div class="form-group">

                    <input type="text" name="last_name" class="form-control"  value="{{$student->last_name}}" placeholder="Enter Last_name">
                </div>

                <input type="submit" class="btn btn-primary">

            </form>



        </div>


    </div>

@endsection
