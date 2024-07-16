// Jquery
(function ($) {
    'use strict';


    var TestimonialCarousel = (function () {
        function TestimonialCarousel(options) {
            var self = this;
            var mainElement = options.main;

            if (!(this instanceof TestimonialCarousel)) {
                throw new TypeError("Cannot call a class as a function");
            }

            this.DOM = { main: mainElement };
            this.DOM.thumbList = this.DOM.main.querySelector(".js-testimonials_thumbs_list");
            this.DOM.thumbItems = this.DOM.thumbList.querySelectorAll("li");
            this.DOM.list = this.DOM.main.querySelector(".js-testimonial_lists");
            this.DOM.testimonials = this.DOM.main.querySelectorAll(".js-testimonial");
            this.DOM.mainRed = document.querySelector(".js-testimonials__red");
            this.DOM.thumbListRed = document.querySelector(".js-testimonials_thumbs_list__red");
            this.DOM.listReds = this.DOM.thumbListRed.querySelectorAll(".thumb-item");
            this.oldActive = 0;

            this.DOM.testimonials.forEach(function (testimonial, index) {
                new Testimonial({ el: testimonial, index: index, onActive: self.onActive.bind(self) });
            });

            this.init();
            this.bindEvent();
        }

        TestimonialCarousel.prototype.init = function () {
            if (this.scrollMask) {
                this.scrollMask.kill();
            }

            if (this.scrollMain) {
                this.scrollMain.kill();
            }

            var windowHeight = Z.winSize.height;
            var lastTestimonialIndex = this.DOM.testimonials.length - 1;
            var firstTestimonialRect = this.DOM.testimonials[0].querySelector(".testimonial_inner").getBoundingClientRect();
            var lastTestimonialRect = this.DOM.testimonials[lastTestimonialIndex].querySelector(".testimonial_inner").getBoundingClientRect();
            var thumbListRect = this.DOM.thumbList.getBoundingClientRect();
            var scrollDistance = lastTestimonialRect.top - firstTestimonialRect.top + windowHeight / 2;

            this.scrollMain = st.i.create({
                trigger: this.DOM.thumbList,
                start: "top+=50% top+=50%",
                end: "" + scrollDistance + "px+=50% bottom",
                pin: true,
            });

            this.scrollMask = st.i.create({
                trigger: this.DOM.thumbListRed,
                start: "top+=50% top+=50%",
                end: "" + scrollDistance + "px+=50% bottom",
                pin: true,
            });
        };

        TestimonialCarousel.prototype.onActive = function (index) {
            this.DOM.thumbItems[this.oldActive].classList.remove("is-active");
            this.DOM.listReds[this.oldActive].classList.remove("is-active");
            this.DOM.thumbItems[index].classList.add("is-active");
            this.DOM.listReds[index].classList.add("is-active");
            this.DOM.main.style = "--index: " + index;
            this.DOM.mainRed.style = "--index: " + index;
            this.oldActive = index;
        };

        TestimonialCarousel.prototype.resize = function () {
            this.scrollMain.kill();
            this.scrollMask.kill();
            this.init();
        };

        TestimonialCarousel.prototype.bindEvent = function () {
            D.on(h, this.resize.bind(this));
            D.on(f, this.resize.bind(this));
        };

        return TestimonialCarousel;
    })();


} (jQuery));