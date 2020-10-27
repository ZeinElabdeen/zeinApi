$(document).ready(function () {
  "use strict";
  new WOW().init();

  $('[data-toggle="tooltip"]').tooltip();

  $(".show-search").click(function (e) {
    e.preventDefault();
    $(".search-block").slideToggle();
    $(".search-block .form-control").focus();
  });

  $(".search-block").click(function () {
    $(this).slideUp();
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 80) {
      $(".navbar").addClass("fixed-top");
    } else {
      $(".navbar").removeClass("fixed-top");
    }
  });

  if ($(window).width() > 991) {
    $(".show-filter").hide();
    $(".search-filter").addClass("show");
  }

  $(window).resize(function () {
    if ($(window).width() > 991) {
      $(".show-filter").hide();
      $(".search-filter").addClass("show");
    }
  });

  $(".show-filter").click(function () {
    $(".search-filter").addClass("show");
    $(".hide-filter").show();
  });

  $(".hide-filter").click(function () {
    $(".search-filter").removeClass("show");
    $(this).hide();
  });

   // increase
  $(".add-btn").on("click", function () {
    var $qty1 = $(this)
      .parent()
      .parent()
      .find(".prod-count-value");
	 
	 if(Number.isInteger(Number($qty1.val()))) 
	 {
		 var currentVal = parseInt($qty1.val()).toFixed(1);
		 if (!isNaN(currentVal) && (currentVal)< 6.5 ) {
		   $qty1.val( (parseFloat(currentVal) + parseFloat(0.1)).toFixed(1) );
		  }
	 }else{
		 var currentVal = parseFloat($qty1.val());
		  if (!isNaN(currentVal) && (currentVal) < 6.5 ) {
		   $qty1.val( (currentVal +  parseFloat(0.1)).toFixed(1) );
		  }
	 }
    // console.log(currentVal);
    
  });

  // decrease
  $(".minuse-btn").on("click", function () {
    var $qty2 = $(this)
      .parent()
      .parent()
      .find(".prod-count-value");
	  
	 if(Number.isInteger(Number($qty2.val()))) 
	 {
	   var currentVal = parseInt($qty2.val()).toFixed(1);
		  if (!isNaN(currentVal) && (currentVal) > 0.5) {
			$qty2.val( (parseFloat(currentVal) -  parseFloat(0.1) ).toFixed(1) );
		   }	   
	 }else{
		var currentVal = parseFloat($qty2.val());
		  if (!isNaN(currentVal) && currentVal > 0.5) {
			$qty2.val( (currentVal -  parseFloat(0.1) ).toFixed(1) );
		   }
	 }
   // console.log(currentVal);

  });

  $(".menu-wrapper").on("click", function () {
    $(".hamburger-menu").toggleClass("animate");
  });

  $(".faqAccordion .btn-link").click(function () {
    if ($(this).hasClass("collapsed")) {
      $(this)
        .find(".icon")
        .attr("data-icon", "minus");
    } else {
      $(this)
        .find(".icon")
        .attr("data-icon", "plus");
    }
  });

  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.avatar').children().attr('src', e.target.result);
        // $('<img src="" alt="img"'+ 'class="preview">').appendTo('.image-preview');
        // $('.preview').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
  $(".input-img").change(function () {
    readURL(this);
  });

  if ($("html").prop("dir") == "rtl") {
    $(".home-slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      cssEase: "ease-in-out",
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false,
      rtl: true,
      customPaging: function (slider, i) {
        var thumb = $(slider.$slides[i]).data();
        return '<a class="dot">' + "0" + i + "</a>";
      },
      responsive: [
        {
          breakpoint: 768,
          settings: {
            dots: false
          }
        }
      ]
    });

    $(".slider-for").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      dots: false,
      asNavFor: ".slider-nav",
      rtl: true
    });

    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]
    
    $(".items-slider .items").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: false,
      arrows: true,
      prevArrow: '<a class="prev-arrow"><img src="'+baseUrl+'/public/assets/front/en/img/icons/prev.png"></a>',
      nextArrow: '<a class="next-arrow"><img src="'+baseUrl+'/public/assets/front/en/img/icons/next.png"></a>',
      focusOnSelect: true,
      rtl: true,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 540,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });
    $(".productview .product-slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false,
      rtl: true
    });
  } else {
    $(".home-slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      cssEase: "ease-in-out",
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false,
      customPaging: function (slider, i) {
        var thumb = $(slider.$slides[i]).data();
        return '<a class="dot">' + "0" + i + "</a>";
      },
      responsive: [
        {
          breakpoint: 768,
          settings: {
            dots: false
          }
        }
      ]
    });
    $(".slider-for").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      dots: false,
      asNavFor: ".slider-nav"
    });
    $(".items-slider .items").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: false,
      arrows: true,
      prevArrow: '<a class="prev-arrow"><img src="'+baseUrl+'/public/assets/front/en/img/icons/prev.png"></a>',
      nextArrow: '<a class="next-arrow"><img src="'+baseUrl+'/public/assets/front/en/img/icons/next.png"></a>',
      focusOnSelect: true,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 540,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });

    $(".productview .product-slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      autoplay: true,
      autoplaySpeed: 2000,
      arrows: false
    });
  }

  $(".slider-nav").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: ".slider-for",
    dots: false,
    arrows: false,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
        }
      }
    ]
  });
});

// $(window).on('load', function () {
//   $('.loading .logo img').delay(2000).fadeOut(function () {
//     $('.loading .logo').hide();
//     $('.loading').fadeOut();
//     $('body').css('overflow', 'auto');
//   })
// });
