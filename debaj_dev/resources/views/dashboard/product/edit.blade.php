
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection
<link  href="{{asset('multiselect')}}/jquery.multiselect.css" rel="stylesheet" />
<style>
.img-wraps {
    position: relative;
    display: inline-block;
    font-size: 0;
    border: solid 2px #cd955e;
    padding: 23px;
}
.img-wraps .closes {
    position: absolute;
    top: 5px;
    right: 8px;
    background-color: #FFF;
    padding: 4px 3px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wraps:hover .closes {
    opacity: 1;
}
</style>
<!-- ============ Body content start ============= -->
@section('content')

    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> المنتجات </a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary">تعديل منتج </strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="upload" action="{{url('dashboard/product/update/'.$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        {{--  Product Name --}}
                        <div class="row">

                            <div class="col-md-6 form-group mb-3">
                                <label for="name_ar">  اسم المنتج العربى </label>
                                <input type="text" class="form-control" name="name_ar" id="title_ar" placeholder=" اسم المنتج العربى" value="{{$product->name_ar}}" autocomplete="off">
                                @if ($errors->has('name_ar'))
                                    <span class="text-danger" role="alert">
     <strong>هذا الحقل مطلوب و يجب أن يكون باللغة العربية</strong>
    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="name_en">اسم المنتج الانجليزي</label>
                                <input type="text" class="form-control" name="name_en" id="name_en" placeholder="الإسم المنتج الإنجليزي" value="{{$product->name_en}}" autocomplete="off">
                                @if ($errors->has('name_en'))
                                    <span class="text-danger" role="alert">
     <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
   </span>
                                @endif
                            </div>
                        </div>
                        {{--  Product ShortDetails --}}
                        <div class="row">

                            <div class="col-md-8 form-group mb-3">
                                <label for="shortDetails_ar">  وصف قصير للمنتج عربى </label>
                                <textarea class="form-control" name="shortDetails_ar" id="shortDetails_ar"  placeholder=" وصف قصير للمنتج عربى"  autocomplete="off">{{$product->shortDetails_ar}}</textarea>
                                @if ($errors->has('shortDetails_ar'))
                                    <span class="text-danger" role="alert">
     <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
   </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 form-group mb-3">
                                <label for="shortDetails_en"> وصف قصير للمنتج انجليزى </label>
                                <textarea class="form-control" name="shortDetails_en" id="shortDetails_en"  placeholder=" Short Description" autocomplete="off">{{$product->shortDetails_en}}</textarea>
                                @if ($errors->has('shortDetails_en'))
                                    <span class="text-danger" role="alert">
                                   <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        {{--  Product Quantity --}}
                        <div class="row">
                            <!--<div class="col-md-6 form-group mb-3">
                                <label for="quantity"> الكمية </label>
                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="الكمية"  value="{{$product->quantity}}">
                                @if ($errors->has('quantity'))
                                    <span class="text-danger" role="alert">
                                       <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
                                     </span>
                                @endif
                            </div> -->

                            {{--  Product Category --}}

                            <div class="col-md-6 form-group mb-3">
                                <div class="form-group">
                                    <label for="category"> القسم </label>
                                    <select class="form-control"  name="category" id="category">
                                      <option value="" >اختر القسم</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ ( $category->id == $product->category_id) ? 'selected' : '' }} >
                                              {{$category->title_ar}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="text-danger" role="alert">
                                         <strong>هذا الحقل مطلوب </strong>
                                       </span>
                                    @endif
                                </div>
                            </div>

                            {{--  Product Color --}}
                                <div class="col-md-6  mb-3">
                                  <label for="color">  اللون  </label>
                                <select class="" name="color[]" id="color" multiple >
                                  @foreach($colors as $row )
                                   <option value="{{ $row->id }}" > {{ $row->name_ar }}</option>
                                  @endforeach
                                </select>
                                    @if ($errors->has('color'))
                                        <span class="text-danger" role="alert">
                                     <strong>هذا الحقل مطلوب </strong>
                                   </span>
                                    @endif
                                </div>

                        </div>

      {{--  Product Size --}}
    <!--  <div class="row">

        <div class="col-md-6 form-group mb-3">
            <label for="size_num"> المقاس بالمتر </label>
            <input type="size_num" class="form-control" step=".1" min="0.5" max="6.5" name="size_num" id="size_num" placeholder="المقاس بالمتر"  value="{{$product->size_num}}">
            @if ($errors->has('size_num'))
                <span class="text-danger" role="alert">
                   <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
                 </span>
            @endif
        </div>

        <div class="col-md-6 form-group mb-3">
          <label for="size">  الحجم </label>
          <select class="form-control" multiple name="size[]" id="size">
             <option value="s">  S  </option>
             <option value="m">  M  </option>
             <option value="l">  L  </option>
             <option value="xl"> XL  </option>
          </select>
            @if ($errors->has('size'))
                <span class="text-danger" role="alert">
             <strong>هذا الحقل مطلوب و يجب أن يكون ارقام </strong>
           </span>
            @endif
        </div>


      </div> -->

    {{--  Product description_ar --}}
    <div class="row">

        <div class="col-md-8 form-group mb-3">
            <label for="description_ar"> وصف المنتج العربى </label>
            <textarea class="form-control" name="description_ar" id="description_ar"  placeholder="  وصف المنتج العربى "  autocomplete="off">{{$product->description_ar}}</textarea>
            @if ($errors->has('description_ar'))
              <span class="text-danger" role="alert">
                <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
              </span>
            @endif
        </div>
    </div>

        {{--  Product description_en --}}
    <div class="row">

        <div class="col-md-8 form-group mb-3">
            <label for="description_en"> وصف المنتج الأنجليزى </label>
            <textarea class="form-control" name="description_en" id="description_en"  placeholder="  وصف المنتج الأنجليزى " autocomplete="off">{{$product->description_en}}</textarea>
            @if ($errors->has('description_en'))
                <span class="text-danger" role="alert">
                  <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
                </span>
            @endif
        </div>
    </div>
    {{--  Product additionalInfo_ar --}}
    <div class="row">

        <div class="col-md-8 form-group mb-3">
            <label for="additionalInfo_ar"> معلومات اضافية للمنتج عربى </label>
            <textarea class="form-control" name="additionalInfo_ar" id="additionalInfo_ar"  placeholder="معلومات اضافية للمنتج عربى"  autocomplete="off">{{$product->additionalInfo_ar}}</textarea>
            @if ($errors->has('additionalInfo_ar'))
                <span class="text-danger" role="alert">
                  <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
                </span>
            @endif
        </div>
    </div>

          {{--  Product additionalInfo_en --}}
      <div class="row">

          <div class="col-md-8 form-group mb-3">
              <label for="additionalInfo_en"> معلومات اضافية للمنتج انجليزى </label>
              <textarea class="form-control" name="additionalInfo_en" id="additionalInfo_en"  placeholder="معلومات اضافية للمنتج عربى" autocomplete="off">{{$product->additionalInfo_en}}</textarea>
              @if ($errors->has('additionalInfo_en'))
                  <span class="text-danger" role="alert">
                   <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>
                 </span>
              @endif
          </div>
      </div>
      {{--  Product Ref --}}
      <div class="row">
          <div class="col-md-6 form-group mb-3">
              <label for="Ref">  الرقم المرجعي  </label>
              <input type="text" class="form-control" name="ref" id="ref" placeholder="Ref"  value="{{$product->ref}}">
              @if ($errors->has('ref'))
                  <span class="text-danger" role="alert">
                   <strong>هذا الحقل مطلوب </strong>
                 </span>
              @endif
          </div>

          {{--  Product price --}}

          <div class="col-md-6 form-group mb-3">
            <label for="price">  السعر  </label>$
              <input type="number" class="form-control" name="price" id="price"  placeholder="السعر$"  value="{{$product->price}}">
              @if ($errors->has('price'))
                  <span class="text-danger" role="alert">
                    <strong>هذا الحقل مطلوب و يجب أن يكون ارقام </strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="col-md-6 form-group mb-3">
        <label for="price"> نسبة الخصم </label>%
          <input type="number" class="form-control" min="1" max="100" name="sale_percentage" id="sale_percentage"  placeholder=" نسبة الخصم"  value="{{$product->sale_percentage}}">
          @if ($errors->has('sale_percentage'))
              <span class="text-danger" role="alert">
                <strong> يجب ان يكون ارقام ما بين 1 الي 100 </strong>
              </span>
          @endif
      </div>

  {{--  Product images --}}

    <div class="input-group mb-3 col-md-6">
      <div class="col-md-12">
          <label for="images"> صور المنتج </label>
      </div>
        <div class="custom-file">
            <input class="custom-file-input" type='file' name="images[]" id="images" accept="image/*" multiple >
            <label class="custom-file-label" for="images" aria-describedby="imagesAddon02">Browse</label>
        </div>
      <br>
      @if ($errors->has('images'))
            <span class="text-danger" role="alert">
                <strong>صورة المنتج مطلوبة و يجب أن تكون بصيغة png,jpeg,jpg</strong>
            </span>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12 form-group mb-3">
          @foreach($images as $image)
            <div  class="img-wraps" id="{{$image->id}}" >
                <span  class="closes" title="مسح" onclick="deleteimg({{$image->id}})">
                  <i class="nav-icon i-Close-Window font-weight-bold delete-btn"></i>
                </span>

                <img src="{{asset('uploads/upload/'.$image->imageName)}}" class="img-responsive" width="200" height="100" >
                @if($image->imageName == $product->main_image)
                <label for="{{$image->id}}" style="position: absolute;top: 85%;left: 27%;color: black;">  الصوره الرئيسية</label>
                @else
                <label id="home{{$image->id}}" style="position: absolute;top: 84%;left: 50%;"
                       title="تعين كرئيسية" onclick="homeimg('{{$image->imageName}}',{{$product->id}},{{$image->id}})">
                  <i class="nav-icon i-home-Window font-weight-bold home-btn" style="font-size: 25px;color: green;"  ></i>
                </label>
                @endif
            </div>
          @endforeach
        </div>
    </div>


                        <script>
                          <?php
                              $p_sizes = explode(',',$product->size);
                              $p_color = explode(',',$product->color);
                          ?>
                          @foreach ($p_sizes as $key => $value)
                          $("#size").find('[value={{$value}}]').attr("selected", "selected");
                          @endforeach
                          @foreach ($p_color as $key => $value)
                          $("#color").find('[value={{$value}}]').attr("selected", "selected");
                          @endforeach
                        </script>
                        <script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace( 'shortDetails_ar' );
                            CKEDITOR.replace( 'shortDetails_en' );
                            CKEDITOR.replace( 'description_ar' );
                            CKEDITOR.replace( 'description_en' );
                            CKEDITOR.replace( 'additionalInfo_ar' );
                            CKEDITOR.replace( 'additionalInfo_en' );
                        </script>
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">حفظ</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>




@endsection
<!-- ============ Body content End ============= -->
@section('js')
<script>
jQuery.noConflict(true);
  document.addEventListener("DOMContentLoaded", function(event) {
      $('#color').multiselect({
          columns: 1,
          placeholder: 'اختر الالوان',
          search: true,
          selectAll: true
      });
      $('#size').multiselect({
          columns: 1,
          placeholder: 'اختر الحجم',
          search: true,
          selectAll: true
      });
  });

  function deleteimg(img_id)
  {
    if(confirm("هل انت متاكد من مسح الصورة !"))
		{
			var data = {'img_id': img_id ,'_token': '{{ csrf_token() }}'};

			 $.ajax({
					url: '{{url("dashboard/product/image_delete")}}',
					type: 'POST',
					data:data,
					async: false,
					success: function (data) {
            if(data.is_done == 1 )
            {
              $("#"+img_id).remove();
            }else{
              alert('حدث خطاء  اثناء مسح الصوره يرجي لعادة المحاولة!');
            }

						}
				});

		}
  }
  function homeimg(img_name,pro_id,img_id)
  {
    if(confirm("هل انت متاكد من تعين كرئيسية!"))
		{
			var data = {'img_name': img_name ,'pro_id': pro_id ,'_token': '{{ csrf_token() }}'};

			 $.ajax({
					url: '{{url("dashboard/product/homeimg")}}',
					type: 'POST',
					data:data,
					async: false,
					success: function (data) {
            if(data.is_done == 1 )
            {
              $("#home"+img_id).remove();
              alert('تم التعين كرئيسية');
            }else{
              alert('حدث خطاء  اثناء التعديل يرجي اعادة المحاولة!!');
            }

						}
				});

		}
  }
</script>
    {{--<script>--}}
    {{--var form = document.getElementById('upload');--}}
    {{--var request = new XMLHttpRequest();--}}
    {{--form.addEventListener('submit',function (e) {--}}
    {{--e.preventDefault();--}}
    {{--var formdata = new FormData(form);--}}
    {{--request.open('post','/store');--}}
    {{--request.addEventListener("load", transferComplete);--}}
    {{--request.send(formdata);--}}
    {{--});--}}
    {{--function transferComplete(data) {--}}
    {{--console.log(data.currentTarget.response);--}}

    {{--}--}}
    {{--    --}}
    {{--</script>--}}

    <script src="{{asset('assets')}}/js/image.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

    </script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $("#form").validate({
// Specify the validation rules
            rules: {
                name: {
                    required: true,
                    alpha: true
                },
                url: {
                    required: true,
                    url:true,
                },

            },
// Specify the validation error messages
            messages: {
                name: {
                    required: 'يرجى إدخال اسم الموقع ',
                    alpha: 'يجب ان يتكون اسم الموقع من حروف فقط ',
                },
                url: {
                    required: 'يرجى إدخال رابط الموقع  ',
                    url:'برجاء ادخال رابط صحيح',
                },
            },
            submitHandler: function (form) {
                form.submit();
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                $(element).closest('.form-group').find('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(element).closest('.form-group').find('.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.closest('.form-group').find('.cke').length) {
                    error.appendTo(element.closest('.form-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>


@endsection
{{--    <script src="https://cdn.tiny.cloud/1/1k63iot7cuvvo0mry8ich4egsgj0e7w674712yhw8foky858/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
{{--    <script>--}}
{{--        tinymce.init({--}}
{{--            selector: '#descriptidon_ar','#description_en',--}}
{{--            directionality : "rtl"--}}
{{--        });--}}
{{--    </script>--}}
<script src="{{asset('multiselect')}}/jquery.min.js"></script>
<script src="{{asset('multiselect')}}//jquery.multiselect.js"></script>
