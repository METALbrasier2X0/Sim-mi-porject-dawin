slideActuel = 0;

$( ".slider-right" ).click(function() {
  if(slideActuel == 0){
    $('.slide2').css({"left": "50%"});
    $('.slide2').css({"animation": "slideRight-Center 1s"});
    $('.slide1').css({"animation": "slideCenter-Left 1s"});
    setTimeout(function(){
      $('.slide1').css({"left": "-50%"});
      $('.slide2').css({"left": "0%"});
      slideActuel = 1;
    }, 1000);
  }
  else{
    $('.slide1').css({"left": "50%"});

    $('.slide1').css({"animation": "slideRight-Center 1s"});
    $('.slide2').css({"animation": "slideCenter-Left 1s"});

    setTimeout(function(){
      $('.slide2').css({"left": "-50%"});
      $('.slide1').css({"left": "0%"});
      slideActuel = 0;
    }, 1000);
  }
});

$( ".slider-left" ).click(function() {
  if(slideActuel == 0){
    $('.slide2').css({"left": "-50%"});

    $('.slide2').css({"animation": "slideLeft-Center 1s"});
    $('.slide1').css({"animation": "slideCenter-Right 1s"});

    $('.slide1').css({"left": "50%"});
    $('.slide2').css({"left": "0%"});
    slideActuel = 1;
  }
  else{
    $('.slide1').css({"left": "-50%"});

    $('.slide1').css({"animation": "slideLeft-Center 1s"});
    $('.slide2').css({"animation": "slideCenter-Right 1s"});

    $('.slide2').css({"left": "50%"});
    $('.slide1').css({"left": "0%"});
    slideActuel = 0;
  }
});
