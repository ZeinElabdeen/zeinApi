<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <button> Get data </button>
    <div id="data"></div>
    <div id="drawData"></div>

    <script>
         $(document).ready(function(){
                            $(document).on('click','button',function(event){
                                // event.preventDefault();
                                // var page = $(this).attr('href').split('page=')[1];
                                // alert('hello');
                                fetch_data();
                            });
                            function fetch_data(){
                                $.ajax({
                                    url:"{{ url('api/get-courses')}}",
                                    success:function(data)
                                    {
                                        // $('#data').html(data);
                                        $('#data').html('done');
                                        drawData(data);

                                    }
                                });
                            }
                            function drawData(data){
                                
                                console.log(data);
                                
                            }
                        });
    </script>
</body>
</html>