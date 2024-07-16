(function ($) {

	"use strict";
	var heading = function ($scope, $) {

		var element = $scope.find('.anime-title');
		var elementSubTitle = $scope.find('.anime-subtitle');

		// var AnimeType = element.attr('data-animate-type');

		// Heading Animation
		var heading = $scope.find('.section-heading');
		var animateType = element.attr('data-animate-type');
		var animateStyle = element.attr('data-animate-style');
		var animateDuration = element.attr('data-animate-duration');

		// Description Animation
		var elementText = $scope.find('.anime-text');
		var desAnimateType = elementText.attr('data-animate-type');
		var desAnimateStyle = elementText.attr('data-animate-style');
		var animationDuration = elementText.attr('data-animate-duration');
		var animationDelay = elementText.attr('data-animate-delay');


		let splitTitleLinesSubTitle = gsap.utils.toArray(elementSubTitle);
		let splitTitleLines = gsap.utils.toArray(element);
		let splitTitleLinesText = gsap.utils.toArray(elementText);

		// Animation Words
		function animationWords(tl, itemSplitted, delay = 0, animateStyle = 'one', duration = 1) {
			if( animateStyle == 'one' ) {
				tl.from(itemSplitted.words, {duration: duration, delay: delay, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
			} else if( animateStyle == 'two' ) {
				tl.from(itemSplitted.words, { opacity: 0, y: 70, duration: duration, ease: "power4.out", stagger: 0.03, delay: delay });
			} else if( animateStyle == 'three' ) {
				tl.from(itemSplitted.words, { duration: duration, x: 70, autoAlpha: 0, opacity: 0, stagger: 0.05, delay: delay });
			}
		}

		// Animation Chars
		function animationChars(tl, itemSplitted, delay = 0, animateStyle = 'one', duration = 1) {
			if( animateStyle == 'one' ) {
				tl.from(itemSplitted.chars, {duration: duration, delay: delay, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
			} else if( animateStyle == 'two' ) {
				tl.from(itemSplitted.chars, { opacity: 0, y: 70, duration: duration, ease: "power4.out", stagger: 0.03, delay: delay });
			} else if( animateStyle == 'three' ) {
				tl.from(itemSplitted.chars, { duration: duration, x: 70, autoAlpha: 0, opacity: 0, stagger: 0.05, delay: delay});
			}
		}

		// Animation Lines
		function animationLines(tl, itemSplitted, delay = 0, animateStyle, duration = 1) {
			if( animateStyle == 'one' ) {
				tl.from(itemSplitted.lines, {duration: duration, delay: delay, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
			} else if( animateStyle == 'two' ) {
				tl.from(itemSplitted.lines, { opacity: 0, y: 70, duration: duration, ease: "power4.out", stagger: 0.1, delay: delay });
			} else if( animateStyle == 'three' ) {
				tl.from(itemSplitted.lines, { duration: duration, x: 70, autoAlpha: 0, opacity: 0, stagger: 0.05, delay: delay});
			}
		}

		// Animation Heading
		splitTitleLines.forEach(splitTextLine => {
			const tl = gsap.timeline({
				scrollTrigger: {
					trigger: splitTextLine,
					start: 'top 90%',
					end: 'bottom 60%',
					scrub: false,
					markers: false,
					toggleActions: 'play none none none'
				}
			});

			const itemSplitted = new SplitText(splitTextLine, { type: animateType });
			gsap.set(splitTextLine, { perspective: 400 });
			itemSplitted.split({ type: animateType })

			if(animateType == 'words') {
				animationWords(tl, itemSplitted, 0, animateStyle, animateDuration);
			} else if(animateType == 'chars' ) {
				animationChars(tl, itemSplitted, 0, animateStyle, animateDuration);
			} else {
				animationLines(tl, itemSplitted, 0, animateStyle, animateDuration)
			}
		});

		// Animation Description
		splitTitleLinesText.forEach(splitTextLine => {
			const tl = gsap.timeline({
				scrollTrigger: {
					trigger: splitTextLine,
					start: 'top 90%',
					end: 'bottom 60%',
					scrub: false,
					markers: false,
					toggleActions: 'play none none none'
				}
			});

			const itemSplitted = new SplitText(splitTextLine, { type: desAnimateType });
			gsap.set(splitTextLine, { perspective: 400 });
			itemSplitted.split({ type: desAnimateType })

			if(desAnimateType == 'words') {
				animationWords(tl, itemSplitted, animationDelay, desAnimateStyle, animationDuration);
			} else if(desAnimateType == 'chars' ) {
				animationChars(tl, itemSplitted, animationDelay, desAnimateStyle, animationDuration);
			} else {
				animationLines(tl, itemSplitted, animationDelay, desAnimateStyle, animationDuration)
			}
		});

		splitTitleLinesSubTitle.forEach(splitTextLine => {
			const tl = gsap.timeline({
				scrollTrigger: {
					trigger: splitTextLine,
					start: 'top 90%',
					end: 'bottom 60%',
					scrub: false,
					markers: false,
					toggleActions: 'play none none none'
				}
			});

			const itemSplitted = new SplitText(splitTextLine, { type: animateType });
			gsap.set(splitTextLine, { perspective: 400 });
			itemSplitted.split({ type: animateType })

			if(animateType == 'words') {
				animationWords(tl, itemSplitted, 0, animateStyle);
			} else if(animateType == 'chars' ) {
				animationChars(tl, itemSplitted, 0, animateStyle);
			} else {
				animationLines(tl, itemSplitted, 0, animateStyle)
			}
		});
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/dmt-heading.default', heading);
	});

})(window.jQuery);