(function ($, elementor) {
	"use strict";

	var Dmt = {

		init: function () {

			var widgets = {
				'dmt-banner-slider.default': Dmt.BannerSlider,
				// 'dmt-hero-static.default': Dmt.Hero,
				'dmt-about.default': Dmt.About,
				'dmt-blog-slider.default': Dmt.BlogSlider,
				'dmt-dynamic-tabs.default': Dmt.DynamicTabs,
				// 'dmt-feature-list-tabs.default': Dmt.Tabs,
				'dmt-testimonial.default': Dmt.Testimonial,
				'dmt-logo-carousel.default': Dmt.Logo,
				'dmt-countdown.default': Dmt.Counting,
				'dmt-product-list.default': Dmt.ProductSlider,
				'dmt-product-tabs.default': Dmt.ProductTabSlider,

			};
			$.each(widgets, function (widget, callback) {
				elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
			});
		},

		About: function ($scope) {
			let heading = $scope.find('.dmt-content__heading');

			let title = document.querySelectorAll('.dmt-content__heading');

			gsap.registerPlugin(ScrollTrigger);

			const tl = gsap.timeline();

			tl.to('.dmt-content__image-left', {
				scrollTrigger: {
					trigger: '.dmt-content__image-left',
					scrub: true
				},
				y: 100,
				scrub: true
			})

			tl.to('.dmt-content__image-right', {
				scrollTrigger: {
					trigger: '.dmt-content__image-right',
					scrub: true
				},
				y:	100,
				scrub: true
			})

			tl.to('.dmt-content__image-bottom', {
				scrollTrigger: {
					trigger: '.dmt-content__image-bottom',
					scrub: true
				},
				y: 200,
				scrub: true
			})




			title.forEach(function (char, i) {
				let heading_title = new SplitText(char, {type: 'chars, words', linesClass: "lineChild"});
				let heading_char = heading_title.chars

				let bg = char.dataset.bgColor
				let fg = char.dataset.fgColor

				gsap.fromTo(heading_char,
					{
						color: bg,
					},
					{
						color: fg,
						duration: 0.3,
						stagger: 0.02,
						opacity: 1,
						scrollTrigger: {
							trigger: char,
							start: "top 80%",
							end: "top 20%",
							toggleActions: "play none none reverse",
							scrub: true
						},
					}
				);
			});
		},

		BannerSlider: function ($scope) {
			var slideInit = $scope.find('[data-banner]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-banner]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-banner'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});
				}
			});

			// const tl = gsap.timeline();
			// tl.to('.swiper-slide-active .banner__title', {
			// 	opacity: 1,
			// 	y: 0,
			// 	duration: 1,
			// 	ease: "power4.out",
			// });
			//
			// tl.to('.swiper-slide-active .banner__description', {
			// 	opacity: 1,
			// 	y: 0,
			// 	duration: 1,
			// 	ease: "power4.out",
			// }, '-=0.5');
			//
			// tl.to('.swiper-slide-active .banner-btn', {
			// 	opacity: 1,
			// 	y: 0,
			// 	duration: 1,
			// 	ease: "power4.out",
			// }, '-=0.5');

		},

		Hero: function ($scope) {
			var element = $scope.find('.marquee-wrap');
			var elementtwo = $scope.find('.marquee-wrap-two');

			element.marquee({
				speed: 5, // this echos 20
				gap: 10,
				delayBeforeStart: 0,
				direction: 'right',
				duplicated: true,
				startVisible: true
			});

			elementtwo.marquee({
				speed: 5, // this echos 20
				gap: 10,
				delayBeforeStart: 0,
				direction: 'left',
				duplicated: true,
				startVisible: true
			});


			let tHero = gsap.timeline()


			var title = $('.banner__title');

			let style = title.attr('data-animation');


			if (style == 'one') {
				let heading_title = new SplitText(".banner__title", {type: 'chars', linesClass: "lineChild"});
				let heading_char = heading_title.chars

				tHero.from(heading_char, {opacity: 0, y: 70, duration: 1.5, ease: "power4.out", stagger: 0.03});
			} else if (style == 'two') {
				let heading_title = new SplitText(".banner__title", {type: "lines, words", linesClass: "lineChild"});
				let heading_char = heading_title.lines
				// tHero.from(heading_char, {duration: 1, delay: 0.3, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
				tHero.from(heading_char, {duration: 1, delay: 0.3, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
			} else if (style == 'three') {
				let heading_title = new SplitText(".banner__title", {type: 'words,chars', linesClass: "lineChild"});
				let heading_char = heading_title.chars
				gsap.set(".banner__title", { perspective: 400 });
				tHero.from(heading_char, {
					duration: 1,
					opacity: 0,
					scale: 0,
					y: 80,
					rotationX: 100,
					transformOrigin: "0% 50% -50",
					ease: "back",
					stagger: 0.05,
				});
			} else if (style == 'four') {
				let heading_title = new SplitText(".banner__title", {type: 'chars,words', linesClass: "lineChild"});
				let heading_char = heading_title.chars
				tHero.from(heading_char, {
					duration: 1, x: 70, autoAlpha: 0, stagger: 0.05
					// duration: 1, y: 50, autoAlpha: 0, stagger: 0.05
				});
			}

			var tl = gsap.timeline(),
				mySplitText = new SplitText(".banner__description", { type: "words,lines" }),
				lines = mySplitText.lines; //an array of all the divs that wrap each character

			// gsap.set(".banner__description", { perspective: 400 });

			tl.from(lines, {
				opacity: 0, y: 70, duration: 2, ease: "power4.out", stagger: 0.2, delay: 1
			});

			tHero.from('.banner-btn', {
				scale: 0.7,  opacity: 0, y: 50, ease: "power4.out", duration: 0.1, delay: 0.01,  stagger: 0.1
			});

			tHero.from(".banner__social-links li i", {
				opacity: 0,
				y:160,
				stagger: 0.2,
				duration: 1,
				ease: "back",
			})

			// Banner Button Animation
			// gsap.set(".banner-btn", { scale: 0.5, opacity: 0, y: 50, ease: "Power2.easeOut", duration: 0.1,  stagger: 0.2 });


			// tHero.from('.banner-btn', {
			// 	opacity: 0,
			// 	y: -70,
			// 	ease: "bounce",
			// 	duration: 1.5
			// }, '-=5');
		},

		DynamicTabs: function ($scope) {
			var tabnav = $scope.find('#dmt-dynamic-tabs-nav li');

			$('#dmt-dynamic-tabs-nav li:nth-child(1)').addClass('active');
			$('#dmt-dynamic-tabs-content .content').hide();
			$('#dmt-dynamic-tabs-content .content:nth-child(1)').show();

			if ($('#dmt-dynamic-tabs-nav li').length > 0) {
				// $('.tt-portfolio__filter').append('<li class="indicator"></li>');
				if ($('#dmt-dynamic-tabs-nav li').hasClass('active')) {
					var cLeft = $('#dmt-dynamic-tabs-nav li.active').position().left + 'px',
						cWidth = $('#dmt-dynamic-tabs-nav li.active').css('width');
					$('.tab-swipe-line').css({
						left: cLeft,
						width: cWidth
					})
				}
			}

			// Tab Click function
			tabnav.on('click', function () {
				$('#dmt-dynamic-tabs-nav li').removeClass('active');
				$(this).addClass('active');

				var cLeft = $('#dmt-dynamic-tabs-nav li.active').position().left + 'px',
					cWidth = $('#dmt-dynamic-tabs-nav li.active').css('width');
				$('.tab-swipe-line').css({
					left: cLeft,
					width: cWidth
				});

				$('#dmt-dynamic-tabs-content .content').hide();

				var activeTab = $(this).find('a').attr('href');
				$(activeTab).fadeIn(600);
				return false;
			});
		},

		Tabs: function ($scope) {
			var tabnav = $scope.find('.dmt-feature .dmt-feature__item');

			$('.dmt-feature .dmt-feature__item:nth-child(1)').addClass('active');
			$('.dmt-feature__image-wrapper .dmt-feature__image').hide();
			$('.dmt-feature__image-wrapper .dmt-feature__image:nth-child(1)').show();

			// Tab Click function
			tabnav.on('click', function () {
				$('.dmt-feature .dmt-feature__item').removeClass('active');
				$(this).addClass('active');
				$('.dmt-feature__image-wrapper .dmt-feature__image').hide();

				var activeTab = $(this).find('a').attr('href');
				$(activeTab).fadeIn(600);
				return false;
			});
		},

		Counting: function ($scope) {
			var counting = $scope.find('.dmt-countdown');

			counting.each(function (index, value) {
				var count_year = $(this).attr("data-count-year");
				var count_month = $(this).attr("data-count-month");
				var count_day = $(this).attr("data-count-day");
				var count_date = count_year + '/' + count_month + '/' + count_day;
				$(this).countdown(count_date, function (event) {
					$(this).html(
						event.strftime('<div class="counting"><span class="CountdownContent">%D<span class="CountdownLabel">Days</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%H <span class="CountdownLabel">Hours</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%M <span class="CountdownLabel">Min</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%S <span class="CountdownLabel">Sec</span></span></div>')
					);
				});
			});
		},

		Slider: function ($scope) {
			var slideInit = $scope.find('[data-swiper]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-swiper]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-swiper'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});
				}
			});
		},

		ProductTabSlider: function ($scope) {
			var slideInit = $scope.find('[data-tab-slider]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-tab-slider]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-tab-slider'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});
				}
			});
		},

		BlogSlider: function ($scope) {
			var slideInit = $scope.find('[data-blog]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-blog]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-blog'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});
				}
			});
		},

		ProductSlider: function ($scope) {

			var slideInit = $scope.find('[data-product]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-product]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-product'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});

				}
			});
		},

		Testimonial: function ($scope) {

			var slideInit = $scope.find('[data-testi]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-testi]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-testi'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});

				}
			});
		},

		Logo: function ($scope) {
			var slideInit = $scope.find('[data-logo]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-logo]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-logo'));
						var mySwiper = new Swiper(swp, config);

						// $('.swiper-slide').on('mouseover', function () {
						// 	mySwiper.autoplay.stop();
						// });
						//
						// $('.swiper-slide').on('mouseout', function () {
						// 	mySwiper.autoplay.start();
						// });
					});
				}
			});
		},

	};
	$(window).on('elementor/frontend/init', Dmt.init);
}(jQuery, window.elementorFrontend));