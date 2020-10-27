
@extends('user.en.layouts.lay') @section('title',' Notes ') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/questions.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

@endsection
@section('content')


<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              {{-- <h2>About-US</h2> --}}
              <span class="text-light">Home / <span> Notes </span>
          </div>
        </div>
      </div>
    </div>
</header>


<!--Start Question Section-->

<section class="question">
    <div class="container">
<div class="accordion" id="accordionExample">

    @if(Session::has('Error'))
            <div class='alert alert-danger text-center' >{{Session::get('Error')}}</div>
    {{Session::forget('Error')}}
    @endif
    @if(Session::has('Success'))
    <div class='alert alert-success text-center' >{{Session::get('Success')}}</div>
    {{Session::forget('Success')}}
    @endif

    <div class="row my-3 align-items-center">
        <div class="col-9">
            <h3 class=" h1" style="color: #565656"> My Notes</h3>
        </div>
        <div class="col-3">
            <div class="text-center">
                <a href="{{url('add-note')}}" class="" style="text-decoration: none">
                    <h4 class=" d-inline" style="color: #565656">  Add Note  <i class="fas fa-plus-circle text-warning" style="font-size:25px"></i> </h4>
                </a>
            </div>

        </div>
    </div>
    

  
    @if($allNotes->isEmpty())
        <h3 class="text-danger text-center my-5"> No Notes yet </h3>
    @else
        @if(Session::has('Error'))
        <div class='alert alert-danger text-center' >{{Session::get('Error')}}</div>
        {{Session::forget('Error')}}
        @endif
        @if(Session::has('Success'))
        <div class='alert alert-uccess text-center' >{{Session::get('Success')}}</div>
        {{Session::forget('Success')}}
        @endif
        @foreach ($allNotes as $note)
        <div class="card">
            <div class="card-header " id="headingOne{{$loop->index}}">
              <h2 class="mb-0">
                  <form action="{{url('deleteNote/'.Session::get('user_id').'/'.$note->note_id)}}" method="post">
                    @csrf
                    <button type="submit" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </form>
               
                <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$loop->index}}" aria-expanded="false" aria-controls="collapseOne">
                   
                    @php
                        echo(substr($note->note_details,0,60).'...');
                    @endphp
                <img src="{{url('storage/images/next.png')}}">
                </button>
                <p class="small-text " >{{\Illuminate\Support\Carbon::parse($note->note_created_at)->diffForHumans()}}</p>            
              
              </h2>
         
            </div>
        
            <div id="collapseOne{{$loop->index}}" class="collapse" aria-labelledby="headingOne{{$loop->index}}" data-parent="#accordionExample">
              <div class="card-body">
                  <form action="{{url('editNote/'.Session::get('user_id').'/'.$note->note_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <textarea name="note_details" id="" class="form-control " rows="10" style="resize: none">{{$note->note_details}}</textarea>
                        @if ($errors->has('note_details'))
                            <p class='text-danger text-left'>{{$errors->first('note_details')}}</p>
                        @endif
                        <img src="{{url('storage/images/notes/'.$note->note_photo)}}" class="my-3" id="img{{$loop->index}}" alt="note_photo" style="cursor:pointer;{{$note->note_photo != 'default.jpg' ? 'width:100%;':''}}">
                        <input type="file" name="note_photo" id="imginput{{$loop->index}}" style="display:none" onchange="showPhoto{{$loop->index}}()">
                        @if ($errors->has('note_photo'))
                            <p class='text-danger text-left'>{{$errors->first('note_photo')}}</p>
                        @endif
                        <button type="submit" class="btn btn-success ml-auto d-block" > Change </button>
                  </form>
                  <script>

                    document.getElementById("img"+{{$loop->index}}).addEventListener("click", function(){
                        document.getElementById("imginput"+{{$loop->index}}).click();
                    });
                    
                    function showPhoto{{$loop->index}}() {
                    var file = document.getElementById('imginput'+{{$loop->index}}).files[0];
                    console.log(file);
                    reader = new FileReader();
                    // console.log(reader);
                    reader.onloadend = function () {
                        document.getElementById('img'+{{$loop->index}}).setAttribute("src",reader.result);
                        // console.log(reader.result);
                    };
                    reader.readAsDataURL(file);
                    }
                
                </script>
                  <p class="text-large">  </p>
              </div>
            </div>
          </div>
        @endforeach
        <div class="row">
            <div class="text-center m-auto" >
                {!!$allNotes->links()!!}
            </div>
        </div>
    @endif
    
   
    
                      
  </div>
</div>
</section>

<!--END Question Section-->

@endsection @section('scripts')
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>

<script>
    var acc = document.getElementsByClassName(" btn-link");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var card = this.nextElementSibling;
    if (card.style.display === "none") {
      
     
    } 
  });
}
</script>


@endsection
