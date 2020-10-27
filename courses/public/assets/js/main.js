
 $("#submit").click(function(){
    Swal.fire(
    'قد تم الحجز بنجاح',
    'You clicked the button!',
    'success');
    });

    /********************* ****/

    $(document).ready(function(){
      $("#s1").click(function(){
        $(".fa-star").css("color,black")
        $("#s1").css("color","yellow");
      });
      $("#s2").click(function(){
        $(".fa-star").css("color,black")
        $("#s1,#s2").css("color","yellow");
      });
      $("#s3").click(function(){
        $(".fa-star").css("color,black")
        $("#s1,#s2,#s3").css("color","yellow");
      });
      $("#s4").click(function(){
        $(".fa-star").css("color,black")
        $("#s1,#s2,#s3,#s4").css("color","yellow");
      });
      $("#s5").click(function(){
        $(".fa-star").css("color,black")
        $("#s1,#s2,#s3,#s4,#s5").css("color","yellow");
      });
    });

    /* course details */

    $(document).ready(function() {
      calTotal();
    });

    $('#weeks_number').change(function(){
      var course_week_price = $('#course_week_price');
      course_week_price.html("");
      var price = $("#weeks_number option:selected" ).attr('price');
      course_week_price.html(price);
      calTotal();
    });

    $('#living').change(function(){
      var living = $('#living_price');
      living.html("");
      var price = $("#living option:selected" ).attr('price');
      living.html(price);
      calTotal();
    });

    $('#reception').change(function(){
      var living = $('#reception_price');
      living.html("");
      var price = $("#reception option:selected" ).attr('price');
      living.html(price);
      calTotal();
    });

    $('#insurance').change(function(){
      var living = $('#insurance_price');
      living.html("");
      var price = $("#insurance option:selected" ).attr('price');
      living.html(price);
      calTotal();
    });

    function calTotal(params) {
      var living_price = parseInt($("#living_price").html());
      var reception_price = parseInt($("#reception_price").html());
      var insurance_price = parseInt($("#insurance_price").html());
      var course_week_price =  parseInt($("#course_week_price").html());
      var registration_fees = parseInt($("#registration_fees").html());
      var living_fees = parseInt($("#living_fees").html());
      var mail_fees = parseInt($("#mail_fees").html());
      var book_fees = parseInt($("#book_fees").html());
      var summer_fees = parseInt($("#summer_fees").html());

      var totalBerforeTax = living_price+reception_price+insurance_price+course_week_price+registration_fees+living_fees+mail_fees+book_fees+summer_fees;
      var tax_fees = parseInt($("#tax_fees").html())/100;
      var total = totalBerforeTax + (totalBerforeTax*tax_fees);
      var totalRounded = total.toFixed(2);

      $('#total').html("");
      $('#total').html(totalRounded);
    }