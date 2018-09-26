new WOW().init();
			  
			  wow = new WOW(
                      {
                      boxClass:     'wow',      // default
                      animateClass: 'animated', // default
                      offset:       0,          // default
                      mobile:       true,       // default
                      live:         true        // default
                    }
                    )
                    wow.init();



//script for work carousel
	
		$(document).ready(function(){
		 $('#logo').owlCarousel({
		loop:true,
		smartSpeed:4000,	 
		margin:10,
		nav:true,
		responsive:{
			0:{
				items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
		});
	

//owl carousel for work script

		$(document).ready(function(){
		 $('#owl-work').owlCarousel({
		loop:true,
		smartSpeed:4000,	 
		margin:10,
		nav:true,
		responsive:{
			0:{
				items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
});



//owl carousel for work-two script

		$(document).ready(function(){
		 $('#owl-work-2').owlCarousel({
		loop:true,
		smartSpeed:4000,	 
		margin:10,
		nav:true,
		responsive:{
			0:{
				items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
});





//owl carousel for customers quotes script

		$(document).ready(function(){
		 $('#customers').owlCarousel({
		loop:true,
		smartSpeed:4000,	 
		margin:10,
		nav:true,
		responsive:{
			0:{
				items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
});
$(document).ready(function(){
	$('#danly').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:5,
            nav:true,
            loop:true
        }
    }
})
});
//navbar transition 
$(document).ready(function(){
	$(window).scroll(function(){
	 var location=$(this).scrollTop();
     if(location<70){
		 $("nav").removeClass("transparent");
	 }else{
		 $("nav").addClass("transparent");
	 }
});			  
				  
});
	
