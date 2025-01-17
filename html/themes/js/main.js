$(function() {

	$(".topbar .down").click(function(){
		$(this).toggleClass("clicked").siblings(".subMenu").slideToggle(128);
	});

	$(".toggleDown").click(function(){
		$(this).toggleClass("toggleDrawer").parent().parent().parent().siblings(".toggleMenu").slideToggle(128);
	});

	$(".heroBanner").owlCarousel({
		itemsCustom : [
			[0, 1],
			[480, 1],
			[768, 1],
			[1024, 1],
			[1400, 1],
			[1600, 1],
		],
		autoPlay : true,
		pagination: true,
		navigation: true,
		navigationText: [
			"<i class='arrow left'></i>",
			"<i class='arrow right'></i>"
		],
	});

	$(".detail .imageDetail").owlCarousel({
		itemsCustom : [
			[0, 1],
			[480, 1],
			[768, 1],
			[1024, 1],
			[1400, 1],
			[1600, 1],
		],
		autoPlay : false,
		pagination: true,
		navigation: false
	});

	$(".thumbView.promo .slideImage").owlCarousel({
		itemsCustom : [
			[0, 1],
			[480, 1],
			[768, 1],
			[1024, 1],
			[1400, 1],
			[1600, 1],
		],
		autoPlay : true,
		pagination: true,
		navigation: false
	});

})