<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>task</title>
</head>
<body>
    <form action="{{url('task')}}" method="post">
        @csrf
        <label for="job"> select Job</label>
        <select name="job" id="job" class="form-control">
            <option value="0">engineer</option>
            <option value="1">doctor</option>
        </select>
        <br>
        <label for="cities"> cities </label>
        <select name="cities" id="cities" class="form-control">
            @foreach ($cities as $city)
                <option value="{{$city->id}}">{{$city->city}}</option>
            @endforeach
        </select>
        <button type="submit" class="form-control btn btn-danger rounded"> submit</button>
    </form>
    @isset($persons)
        <table border=1>
            <thead>
                <th>id</th>
                <th>first_name</th>
                <th>last_name</th>
                <th>email</th>
                <th>job</th>
                <th>city</th>
            </thead>
            <tbody>
                @foreach ($persons as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->last_name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->job == 0 ? 'enginner' : 'doctor'}}</td>
                        <td>
                            @php
                            $realCity = '';
                            foreach ($cities as $key => $c) {
                                if($c->id == $item->city){
                                    $realCity =$c->city;
                                    break;
                                }
                                 
                            }
                                
                            @endphp
                            {{$realCity}}
                            {{-- {{$item->city}} --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endisset

    <table border=1>
        <thead>
            <th>id</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>email</th>
            <th>job</th>
            <th>city</th>
        </thead>
        <tbody id="js">
                
        </tbody>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#job,#cities').change(function(){
                city = $('#cities').val();
                job = $('#job').val();
                // alert(city + job);
                $.ajax({
                    url:"{{url('api/task/')}}",
                    method:'post',
                    data:{city:city,job:job},
                    success:function(data)
                    {
                        $('#js').html("");
                        $(function() {
                            var x = 0;
                            $.each(data, function(i, item) {
                                $('#js').append('<tr id='+i+'>');
                                
                                var $td = $('#'+i).append(
                                    $('<td>').text(item[i].id),
                                    $('<td>').text(item[i].first_name),
                                    $('<td>').text(item[i].last_name),
                                    $('<td>').text(item[i].email),
                                    $('<td>').text(item[i].job),
                                    $('<td>').text(item[i].city),
                                ); //.appendTo('#records_table');
                                // console.log($tr.wrap('<p>').html());
                                x++;
                                console.log(x);
                                    
                            });
                        });

                        // console.log(data);

                        // $('#supplier_table').html(data);
                    }
                });
            });
        });
    </script>
    
</body>
</html>