$(function(){
	var BJS={};
	BJS.get = function(url,params,callback){
		jQuery.ajax({
			url:url,
			type: "GET",
			cache: false,
			data: params,
			success: callback
		});
	}
	BJS.post = function (url,params,callback){
		jQuery.ajax({
			url:url,
			type: "POST",
			cache: false,
			data: params,
			success: callback
		});
	}
	BJS.JSON = function (url,params,callback){
		jQuery.ajax({
			url:url,
			type: "GET",
			cache: false,
			dataType:"json",
			data: params,
			success: callback
		});
	}
	BJS.center=function(){
		var siteHeight=600;
		var windowHeight=$(window).height();
		if(windowHeight>siteHeight){
			var diferencia=windowHeight-siteHeight;
			var marginTop=diferencia/2;
			$("#container").css({"margin-top":marginTop}).fadeIn("slow");
		}
	}
	BJS.verticalCenter=function(selector){
	var $node=$(selector);
	var $container=$node.parent();
	var containerHeight=$container.height();
	var nodeHeight=$node.height();
	var marginTopNode=(containerHeight>nodeHeight)?(containerHeight-nodeHeight)/2:0;
	$node.css({"marginTop":marginTopNode});
}
//SUPERSIZE
	var image={};
	BJS.JSON("/pictures/getBackground",{},function(data){
		image=data;	
		$.supersized({
						//Functionality
		slideshow               :   1,		//Slideshow on/off
		autoplay				:	1,		//Slideshow starts playing automatically
		start_slide             :   1,		//Start slide (0 is random)
		random					: 	0,		//Randomize slide order (Ignores start slide)
		slide_interval          :   3000,	//Length between transitions
		transition              :   1, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed		:	500,	//Speed of transition
		new_window				:	1,		//Image links open in new window/tab
		pause_hover             :   0,		//Pause slideshow on hover
		keyboard_nav            :   1,		//Keyboard navigation on/off
		performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
		image_protect			:	1,		//Disables image dragging and right click with Javascript
		image_path				:	'/img/uploads', //Default image path

		//Size & Position
		min_width		        :   0,		//Min width allowed (in pixels)
		min_height		        :   0,		//Min height allowed (in pixels)
		vertical_center         :   1,		//Vertically center background
		horizontal_center       :   1,		//Horizontally center background
		fit_portrait         	:   1,		//Portrait images will not exceed browser height
		fit_landscape			:   0,		//Landscape images will not exceed browser width
		
		//Components
		navigation              :   1,		//Slideshow controls on/off
		thumbnail_navigation    :   1,		//Thumbnail navigation
		slide_counter           :   1,		//Display slide numbers
		slide_captions          :   1,		//Slide caption (Pull from "title" in slides array)
		slides 					:  	[		//Slideshow Images
											{image :"/img/uploads/"+image.Picture.image, title : '', url : ''}/*,  
											{image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.1/slides/wanderers-kitty.jpg', title : 'Wanderers by Kitty Gallannaugh', url : 'http://www.nonsensesociety.com/2010/12/kitty-gallannaugh/'},  
											{image : 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.1/slides/apple-kitty.jpg', title : 'Applewood by Kitty Gallannaugh', url : 'http://www.nonsensesociety.com/2010/12/kitty-gallannaugh/'}  */
									]
		}); 
		console.log(image.Picture.image);
	});

//SLIDE
	$(".scrollable").scrollable();
});