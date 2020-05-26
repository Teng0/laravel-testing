@extends("master")

@section("content")


    <div class="row">
        <div class="col-md-12">
            <br />
                <h3 align="center">Students Data</h3>
            <br />
            @if ($message =\Illuminate\Support\Facades\Session::get('success'))

                <div class="allert  alert-success">

                    <p>{{$message}}</p>

                </div>
            @endif
            <div align="right">
                <a href="{{route('student.create')}}" class="btn btn-primary">Add Student</a>
            </div>

        </div>

        <table class="table table-bordered table-striped">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            @foreach($students as $row)
                <tr>
                   <td>{{$row["first_name"]}}</td>
                    <td>{{$row["last_name"]}}</td>
                    <td><a href="{{action('studentController@edit', $row['id'])}}" class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{action('studentController@destroy', $row['id'])}}" method="post" class="delete_form">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script>
        $(document).ready(function () {

            $(".delete_form").on("submit",function () {
                console.log("WORKS")
                if(confirm("Are you sure you want to delete it ?")){
                    return true
                }
                else{
                    return false
                }
            })
        });

    </script>

@endsection

