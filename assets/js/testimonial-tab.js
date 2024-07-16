(function ($) {
	"use strict";

	var testimonialTab = function ($scope, $) {
		let device_width = window.innerWidth
		let slider = $scope.find(".dmt-tab-testimonial");

		if (device_width > 992) {
			gsap.to(".dmt-tab-testimonial__list", {
				scrollTrigger: {
					trigger: ".dmt-tab-testimonial",
					pin: ".dmt-tab-testimonial__list",
					pinSpacing: false,
					start: "top top",
					end: "bottom bottom",

				},
			})

			let navItems = gsap.utils.toArray(".dmt-tab-testimonial__list li a")
			if (navItems) {
				navItems.forEach((nav) => {
					nav.addEventListener("click", (e) => {
						e.preventDefault()
						const ids = nav.getAttribute("href")
						gsap.to(window, {
							duration: 0.5,
							scrollTo: ids,
							ease: "power4.out",
						})
					})
				})
			}

			// Define a function to update the active elements
			function updateActiveElements() {
				$(".dmt-tab-testimonial__item").each(function () {
					const elementTop = $(this).offset().top;
					const elementBottom = elementTop + $(this).outerHeight();
					const scrollTop = $(document).scrollTop();
					const windowHeight = $(window).height();

					if (elementTop <= scrollTop + windowHeight - 200  && elementBottom >= scrollTop) {
						var sec_id = $(this).data("secid");
						$(this).addClass("active").siblings().removeClass("active");

						$(".dmt-tab-testimonial__list li:nth-child(" + sec_id + ")")
							.addClass("active")
							.siblings()
							.removeClass("active");
					}
				});
			}

			// Call the updateActiveElements function initially
			updateActiveElements();

			// Use ScrollTrigger to trigger the updateActiveElements function on scroll
			gsap.registerPlugin(ScrollTrigger);

			ScrollTrigger.create({
				trigger: ".dmt-tab-testimonial__item",
				onEnter: updateActiveElements,
				onLeaveBack: updateActiveElements,
				onEnterBack: updateActiveElements,
			});

			$(window).on("scroll", updateActiveElements); // This is for cases when the page is scrolled without using ScrollTrigger

		}
	}

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/rbt_testimonial_tabs.default', testimonialTab);
	});

})(window.jQuery);