@extends('admin.layouts.nav')
@section('title','Profile')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            @if(Session::has('Success'))
                <div class="alert alert-success text-center">{{Session::get('Success')}}</div>
            @endif
            @php
            if(Session::get('Success')){
                Session::forget('Success');
            } 
            @endphp

            @if(Session::has('Error'))
                <div class="alert alert-danger text-center">{{Session::get('Error')}}</div>
            @endif
            @php
            if(Session::get('Error')){
                Session::forget('Error');
            } 
            @endphp
          </div>
          
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ url('storage/images/passports/'.$profile->passport_photo) }}"
                       style="height:100%;width:100%"
                       alt="User profile picture"
                       id="img">
                </div>

                <h3 class="profile-username text-center"></h3>


                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Name</b> <a class="float-right">{{ $profile->student_name }}</a>

                  </li>
                  <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{ $profile->student_phone }}</a>

                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{ $profile->student_email }}</a>

                  </li>
                </ul>

                {{-- <a href="#" class="btn btn-primary btn-block " ><b>Edit</b></a> --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#courses" data-toggle="tab">Reservations</a></li>
                  <li class="nav-item"><a class="nav-link" href="#rate" data-toggle="tab">Rates</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Wishlist</a></li>
                  <li class="nav-item"><a class="nav-link" href="#notes" data-toggle="tab">Notes</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="courses">
                    <!-- Post -->
                    @isset($courses)
                    @foreach ($courses as $c)
                        <div class="post">
                        <div class="user-block" >
                          {{-- <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image"> --}}
                          <span class="username" style="margin-left:0px">
                            <a href="#">{{ $c->course_name }}</a>
                            {{-- <a href="#" class="float-right btn-tool"><i class="{{ $c->complete == 1 ? 'fas fa-times' : ''}}"></i></a> --}}
                          </span>
                          <span class="description" style="margin-left:0px">{{ $c->institute_name }} - {{\Illuminate\Support\Carbon::parse($c->created_at)->diffForHumans()}}</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            {!! $c->course_details !!}
                        </p>
                      </div>
                    @endforeach
                    @endisset

                    @empty($courses)
                      <p>No Reservations Yet</p>
                    @endempty

                    <!-- /.post -->

                   
                    <!-- /.post -->
                  </div>
                  {{-- courses rate --}}
                  <div class="tab-pane" id="rate">
                    @isset($rates)
                    @foreach ($rates as $rate)

                    <!-- Post -->
                    <div class="post" >

                        <div class="row">
                            <div class="col-4">
                                <div class="user-block">
                                    {{-- <img class="img-circle img-bordered-sm" src="{{url('storage/images/passports/'.$rate->passport_photo)}}" alt="{{$rate->student_name}}"> --}}
                                    <span class="username" style="margin-left:0px">
                                        <a href="#">{{$rate->course_name}}</a>
                                        <a href="#" class="float-right btn-tool"></a>
                                    </span>
                                    <span class="description" style="margin-left:0px">{{\Illuminate\Support\Carbon::parse($rate->rate_created_at)->diffForHumans()}}</span>

                                </div>
                            </div>
                            <div class="col-8">
                                    @for ($i = 0; $i < $rate->course_rate_value; $i++)
                                      <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                                    @endfor
                                    @for ($i = 0; $i < 5-$rate->course_rate_value ; $i++)
                                      <li class="list-inline-item"><i class="fas fa-star"></i></li>
                                    @endfor
                            </div>
                        </div>

                        <!-- /.user-block -->

                    </div>
                    <!-- /.post -->

                    @endforeach
                    @endisset
                    @empty($rates)
                        <p>No Rates Yet</p>
                    @endempty
                  </div>
                  {{-- courses rate --}}
                  <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                      @isset($wishlist)

                        @foreach ($wishlist as $w)
                        <div class="post">
                        <div class="user-block" >
                          {{-- <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image"> --}}
                          <span class="username" style="margin-left:0px">
                            <a href="#">{{ $w->course_name }}</a>
                            {{-- <a href="#" class="float-right btn-tool"><i class="{{ $w->complete == 1 ? 'fas fa-times' : ''}}"></i></a> --}}
                          </span>
                          <span class="description" style="margin-left:0px">{{ $w->institute_name }}</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            {!! $c->course_details !!}
                        </p>
                      </div>
                      @endforeach
                      @endisset
                      @empty($wishlist)
                          <p>No items Yet</p>
                      @endempty
                    </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="notes">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a type="button"  class="d-inline" style="color: #565656" data-toggle="modal" data-target="#addmodal">
                                <i class="fas fa-plus-circle text-warning" style="font-size:25px"></i>  Add Note
                            </a>
                        </div>
                    </div>
                    <hr>
                    @isset($notes)
                        @foreach ($notes as $note)
                            <div class="post" >
                                <div class="col-12">
                                    <div class="row text-right" style="justify-content: flex-end;">
                                        <div class="form-group">
                                            <span class="description" style="margin-left:0px">{{\Illuminate\Support\Carbon::parse($note->note_created_at)->diffForHumans()}}</span>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="form-group">
                                            <form action="{{url('admin/deleteNote/'.$note->student_id.'/'.$note->note_id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="close" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{url('admin/editNote/'.$note->student_id.'/'.$note->note_id)}}" method="post" enctype="multipart/form-data">
                                    @csrf


                                    <div class="row ">


                                        <div class="col-4">
                                            <label for="">Note photo</label>
                                            <img src="{{$note->note_photo == null ? url('storage/images/notes/default.jpg') : url('storage/images/notes/'.$note->note_photo)}}" class="my-3" id="imgnote{{$loop->index}}" alt="note_photo" style="cursor:pointer;{{$note->note_photo != 'default.jpg' ? 'width:100%;':''}}">
                                            <input type="file" name="note_photo" id="imginputNote{{$loop->index}}" style="display:none" onchange="showPhotoNote{{$loop->index}}()">
                                            @if ($errors->has('note_photo'))
                                                <p class='text-danger text-left'>{{$errors->first('note_photo')}}</p>
                                            @endif
                                        </div>
                                        <div class="mx-3" style="border-left: 1px solid black;height: 200px;"></div>
                                        <div class="col-7">
                                            <label for="">Note details</label>
                                            <textarea name="note_details" id="" class="form-control my-3" rows="5"  style="resize: none">{{$note->note_details}}</textarea>
                                            @if ($errors->has('note_details'))
                                                <p class='text-danger text-left'>{{$errors->first('note_details')}}</p>
                                            @endif
                                        </div>
                                        <div class="col-12 my-2">
                                            <button type="submit" class="btn btn-sm btn-success ml-auto d-block" > save</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <style>
                                #imgnote{{$loop->index}}{
                                cursor: pointer;
                            }
                           </style>
                            <script>

                                // institute upload photo function
                                    document.getElementById("imgnote{{$loop->index}}").addEventListener("click", function(){
                                        document.getElementById("imginputNote{{$loop->index}}").click();
                                    });
                                    function showPhotoNote{{$loop->index}}() {
                                    var file = document.getElementById('imginputNote{{$loop->index}}').files[0];
                                    console.log(file);
                                    reader = new FileReader();
                                    // console.log(reader);
                                    reader.onloadend = function () {
                                        document.getElementById('imgnote{{$loop->index}}').setAttribute("src",reader.result);
                                        // console.log(reader.result);
                                    };
                                    reader.readAsDataURL(file);
                                    }

                            </script>
                        @endforeach
                    @endisset
                    @empty($notes)
                        <p>No notes Yet</p>
                    @endempty
                  </div>

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="post" action="{{url('/admin/student/'.$profile->student_id)}}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="student_name" value="{{$profile->student_name}}">
                          @if($errors->has('student_name'))
                            <p class="text-danger">{{$errors->first('student_name')}}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="student_email" value="{{$profile->student_email}}">
                          @if($errors->has('student_email'))
                           <p class="text-danger">{{$errors->first('student_email')}}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="student_phone" value="{{$profile->student_phone}}">
                          @if($errors->has('student_phone'))
                           <p class="text-danger">{{$errors->first('student_phone')}}</p>
                          @endif
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Passport Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="student_passport_name" value="{{$profile->student_passport_name}}">
                          @if($errors->has('student_passport_name'))
                          <p class="text-danger">{{$errors->first('student_passport_name')}}</p>
                         @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Passport Number</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inputName" name="student_passport_number" value="{{$profile->student_passport_number}}">
                          @if($errors->has('student_passport_number'))
                          <p class="text-danger">{{$errors->first('student_passport_number')}}</p>
                         @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Passport Name</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control" id="imginput" name="passport_photo" onchange="showPhoto()" >
                          <input type="hidden" name="old_photo_name" id="" value="{{$profile->passport_photo}}">
                          @if($errors->has('passport_photo'))
                          <p class="text-danger">{{$errors->first('passport_photo')}}</p>
                         @endif
                         @if($errors->has('old_photo_name'))
                          <p class="text-danger">{{$errors->first('old_photo_name')}}</p>
                         @endif
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <form action="{{url('admin/addNote/'.$profile->student_id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="mediumModalLabel">Add Address</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="modal-body">
                          <div class="col-12">
                              <div class="form-group">
                                  <label class="control-label mb-1">Photo</label>
                                  <img src="" alt="" id="imgModel">
                                  <input name="note_photo_model" type="file" class="form-control @error('note_photo') is-invalid  @enderror" value="{{old('note_photo')}}" id="imginputModel" onchange="showPhotoModel()" >
                                  @if ($errors->addnote->has('note_photo'))
                                  <p class="text-danger">{{ $errors->addnote->first('note_photo') }}</p>
                                  @endif
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <label  class="control-label mb-1">Details</label>
                                  <textarea name="note_details_model" class="form-control @error('note_details') is-invalid  @enderror" id="" cols="30" rows="5" placeholder="add note deatails" required>{{old('note_details')}}</textarea>
                                      @if ($errors->addnote->has('note_details'))
                                      <p class="text-danger">{{ $errors->addnote->first('note_details') }}</p>
                                      @endif

                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" name="student_id" id="inputAddModal" value="{{$profile->student_id}}">
                      <button type="submit" class="btn btn-success">Add</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
              </div>

          </form>
      </div>
  </div>

@endsection
@section('scripts')
    <script>
       

        function showPhoto() {
        var file = document.getElementById('imginput').files[0];
        console.log(file);
        reader = new FileReader();
        // console.log(reader);
        reader.onloadend = function () {
            document.getElementById('img').setAttribute("src",reader.result);
            // console.log(reader.result);
        };
        reader.readAsDataURL(file);
        }
    </script>

    <script>
      // show photo model
      document.getElementById("imgModel").addEventListener("click", function(){
      document.getElementById("imginputModel").click();
      });
      function showPhotoModel() {
      var file = document.getElementById('imginputModel').files[0];
      console.log(file);
      reader = new FileReader();
      // console.log(reader);
      reader.onloadend = function () {
          document.getElementById('imgModel').setAttribute("src",reader.result);
          // console.log(reader.result);
      };
      reader.readAsDataURL(file);
      }
  </script>
  @if (count($errors) > 0)
  <script>
      $(document).ready(function(){
            $('#addmodal').modal('show');
        });
  </script>

  @endif
@endsection