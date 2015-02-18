	$(window).load(function() {
		$('#slider').nivoSlider({
		effect:'sliceDownLeft', // sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random
		animSpeed:500,
		pauseTime:3000,
		directionNav:false, //Next and Prev
		directionNavHide:false, //Only show on hover
		controlNav:true, //1,2,3...
		pauseOnHover:false, //Stop animation while hovering
		beforeChange: function(){},
		afterChange: function(){}
		});
	});
