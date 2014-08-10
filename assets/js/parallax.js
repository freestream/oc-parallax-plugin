/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 Anton Samuelsson
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
var FreestreamParallax = function(options) {
    var that = this,
        opt = options || {};

    /**
     * Initiate.
     */
    that.init = function() {
        $('#fullpage').fullpage({
            verticalCentered: opt.verticalCentered,
            resize : opt.resize,
            anchors: opt.anchors,
            scrollingSpeed: opt.scrollingSpeed,
            menu: opt.menu,
            navigation: opt.navigation,
            navigationPosition: opt.navigationPosition,
            navigationTooltips: opt.navigationTooltips,
            slidesNavigation: opt.slidesNavigation,
            slidesNavPosition: opt.slidesNavPosition,
            loopBottom: opt.loopBottom,
            loopTop: opt.loopTop,
            loopHorizontal: opt.loopHorizontal,
            autoScrolling: opt.autoScrolling,
            scrollOverflow: opt.scrollOverflow,
            css3: opt.css3,
            paddingTop: opt.paddingTop,
            paddingBottom: opt.paddingBottom,
            normalScrollElements: opt.normalScrollElements,
            normalScrollElementTouchThreshold: opt.normalScrollElementTouchThreshold,
            keyboardScrolling: opt.keyboardScrolling,
            touchSensitivity: opt.touchSensitivity,
            continuousVertical: opt.continuousVertical,
            animateAnchor: opt.animateAnchor,

            sectionSelector: '.section',
            slideSelector: '.slide',

            //events
            onLeave: function(index, nextIndex, direction){},
            afterLoad: function(anchorLink, index){},
            afterRender: function(){},
            afterResize: function(){},
            afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){},
            onSlideLeave: function(anchorLink, index, slideIndex, direction){}
        });
    };

    that.init();
    return that;
};
