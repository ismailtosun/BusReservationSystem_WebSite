
function hoverimage() 
{
	jQuery("a[rel^='prettyPhoto']").each(function() {	
		var $image = $(this).contents("img");
			$hoverclass = 'hover_video';

		if($(this).attr('href').match(/(jpg|gif|jpeg|png|tif)/)) 
		$hoverclass = 'hover_image';
		
		if ($image.length > 0)
		{	
			var $hoverbg = $("<span class='"+$hoverclass+"'></span>").appendTo($(this));
			
				$(this).bind('mouseenter', function(){
				$height = $image.height();
				$width = $image.width();
				$pos =  $image.position();		
				$hoverbg.css({height:$height, width:$width, top:$pos.top, left:$pos.left});
			});
		}
	
	});	

	jQuery("a[rel^='prettyPhoto']").contents("img").hover(function() {
		jQuery("span[class^=hover]").stop().animate({"opacity": "1"},400); 
		},function() {
		jQuery("span[class^=hover]").stop().animate({"opacity": "0"},400); 
	});
}


function sys_toggle() {
	jQuery(".toggle_content").hide(); 

	jQuery("h4.toggle").toggle(function(){
		jQuery(this).addClass("active");
		}, function () {
		jQuery(this).removeClass("active");
	});

	jQuery("h4.toggle").click(function(){
		jQuery(this).next(".toggle_content").slideToggle();
	});
}

function k_menu()
{
	// k_menu controlls the dropdown menus and improves them with javascript
	
	jQuery(".nav a").removeAttr('title');
	jQuery(" .nav ul ").css({display: "none"}); // Opera Fix
	
	//smooth drop downs
	jQuery(".nav li").each(function()
	{	
		
		var $sublist = jQuery(this).find('ul:first');
		
		jQuery(this).hover(function()
		{	
			$sublist.stop().css({overflow:"hidden", height:"auto", display:"none", paddingTop:30}).slideDown(400, function()
			{
				jQuery(this).css({overflow:"visible", height:"auto"});
			});	
		},
		function()
		{	
			$sublist.stop().slideUp(400, function()
			{	
				jQuery(this).css({overflow:"hidden", display:"none"});
			});
		});	
	});

	//  Menu mouse hovered background
}

function iconanimation() 
{
	var $portfolio_item = $('.portimg');

	$portfolio_item.hover(function(event){
		jQuery(this).find('.porthumb').stop(true, true).animate({top: -10}, 500).find('img.image').stop(true, true).animate({opacity: 0.6},500);
	}, function(event){
		jQuery(this).find('.porthumb').stop(true, true).animate({top: 0}, {
			duration: 500, 
			easing: 'swing'
		}).find('img.image').stop(true, true).animate({opacity: 1},{
			duration: 500, 
			easing: 'swing'
		});
	});
}

jQuery(document).ready(function() {
	jQuery(".button").hover(function(){
		var $hoverBg = jQuery(this).attr('btn-hoverBg');
		var $hoverColor = jQuery(this).attr('btn-hoverColor');
		if($hoverBg!=undefined){
			jQuery(this).css('background-color',$hoverBg);
		}else{

		}
		if($hoverColor!=undefined){
			jQuery('span',this).css('color',$hoverColor);
		}else{

		}
	},
	function(){
		var $bg = jQuery(this).attr('btn-bg');
		var $color = jQuery(this).attr('btn-color');
		if($bg!=undefined){
			jQuery(this).css('background-color',$bg);
		}
		if($color!=undefined){
			jQuery('span',this).css('color',$color);
		}
	});

});

jQuery(function(){
	iconanimation()
	hoverimage();
	k_menu();
	sys_toggle();

	jQuery('ul.sf-menu ul li span').css({display:'none'});
	jQuery('.nav li ul li span').css({display:'none'});
	jQuery('.sitemap li span').css({display:'none'});
    jQuery(".porthumb, .gallery, .gallery-item, .post-img, .imagethumb, .image").preloadify({ imagedelay:"500"});
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({theme:'light_square'});
	jQuery("ul.tabs").tabs("> .tab_content", {tabs:'li',effect: 'fade', fadeOutSpeed: -400});
});