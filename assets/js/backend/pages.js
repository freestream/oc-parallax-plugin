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
    /**
     * Initial variables.
     */
    var that = this,
        opt = options || {},
        adjustment;

    var counter = 0;

    opt.horizontal_button_text = opt.horizontal_button_text || 'Add horizontal page';
    opt.vertical_button_text = opt.vertical_button_text || 'Add vertical page';

    /**
     * Initiate
     */
    that.init = function() {
        that.initiateSortable();

        $('ol#parallax-pages div.controls i.fa.fa-times').on( "click", function() {
            $(this).parent().parent().remove();
            updateJsonString();
        });
    };

    /**
     * Setup sortable elements.
     */
    that.initiateSortable = function() {
        $("ol#parallax-pages").sortable({
            group: 'page_selector',
            nested: true,
            vertical: true,
            onDrop: function  (item, targetContainer, _super) {
                var clonedItem = $('<li/>').css({height: 0});

                that.setClassToItem(item);

                item.before(clonedItem);
                clonedItem.animate({'height': item.height()});

                item.animate(clonedItem.position(), function  () {
                    clonedItem.detach();

                    if (item.parents('ol').length > 1) {
                        item.find('ol').remove();
                    } else {
                        item.find('.btn').before('<ol></ol>');
                    }

                    _super(item)
                });

                /**
                 * Flatten any multi level children.
                 */
                if (targetContainer.el.get(0) !== $('#parallax-pages').get(0)) {
                    item.find("li").detach().appendTo(item.parent());
                } else {
                    item.find('.btn')
                        .html(opt.horizontal_button_text)
                        .appendTo(item);
                }

                updateJsonString();
            },
            onDragStart: function ($item, container, _super) {
                var offset = $item.offset(),
                    pointer = container.rootGroup.pointer

                if (pointer) {
                    cursorAdjustment = {
                        left: pointer.left - offset.left,
                        top: pointer.top - offset.top
                    }
                }
                else {
                    cursorAdjustment = null
                }

                cursorAdjustment = this.tweakCursorAdjustment(cursorAdjustment)

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top,
                    height: $item.height(),
                    width: $item.width(),
                    compensate: $item.find('.btn').is(':visible')
                }

                $item.addClass("dragged")
                $("body").addClass("dragging")
            },
            onDrag: function ($item, position, _super, event) {
                if (adjustment.compensate) {
                    adjustment.height -= $item.find('.btn').height();
                }

                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top,
                    'min-height': adjustment.height,
                    'min-width':  adjustment.width,
                })
            }

        });
    };

    /**
     * Removes all existing page-level class and add a new.
     *
     * @param {[element]} item
     */
    that.setClassToItem = function(item) {
        item.removeClass (function (index, css) {
            return (css.match (/^pages-level-\d+/g) || []).join(' ');
        });

        item.addClass('pages-level-' + item.parents('ol').length);
    };

    /**
     * Returns a clean innerText from a elements.
     *
     * @param  {element} element
     *
     * @return {string}
     */
    function getCleanElementText(element)
    {
        return $(element).find('>.page-heading').text().trim();
    }

    /**
     * Returns a JSON object of element.
     *
     * @param  {element} element
     * @param  {boolean} addChildBlock
     *
     * @return {JSON}
     */
    function getJsonElement(element, addChildBlock)
    {
        if (typeof addChildBlock === 'undefined') {
            addChildBlock = false;
        }

        json = {}
        json["title"] = getCleanElementText(element);
        json["pagename"] = $(element).data('pagename');

        if (addChildBlock) {
            json["children"] = [];
        }

        return json;
    }

    function updateJsonString() {
        jsonObj = [];
        $("#parallax-pages").children('li').each(function (index, element) {
            if ($(element).find('>.page-heading').text().trim()) {

                parent = getJsonElement(element, true);

                $(element).find('ol').children('li').each(function (subIndex, subElement) {
                    subTmp = {}

                    if ($(subElement).find('>.page-heading').text().trim()) {
                        child = getJsonElement(subElement);
                        parent["children"].push(child);
                    }
                });

                jsonObj.push(parent);
            }
        });

        $('#Form-field-Parallaxes-pages').val(JSON.stringify(jsonObj));
    }

    /**
     * Event listener for when a new page is added from the widget.
     *
     * @param  {JSON} event
     */
    document.addEventListener("freestream.parallax.backend.newPageSelected", function(event) {
        var element = event.detail.element;
        var tracker = event.detail.tracker;
        var button_text = event.detail.button_text;

        addPageAtTracker(element, tracker, button_text);
        updateJsonString();
    });

    /**
     * Adds a new page to closest ol from tracker element.
     *
     * @param {element} element
     * @param {string} tracker
     * @param {string} button_text
     */
    function addPageAtTracker(element, tracker, button_text)
    {
        trackerElement = $('#' + tracker);
        parentElement = trackerElement.prev('ol');

        level = (parentElement.attr('id') == 'parallax-pages') ? 1 : 2;

        element.addClass('pages-level-' + level);

        if (level === 1) {
            element.find('.btn')
                .html(button_text)
                .appendTo(element);
        }

        parentElement.append(element);
    }

    that.init();
    return that;
};
