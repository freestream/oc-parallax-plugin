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
var FreestreamParallax = function() {
    /**
     * Initial variables.
     */
    var that = this,
        adjustment;

    /**
     * Initiate
     */
    that.init = function() {
        that.initiateSortable();
    };

    /**
     * Setup sortable elements.
     */
    that.initiateSortable = function() {
        $("ol.simple_with_animation").sortable({
            group: 'simple_with_animation',
            pullPlaceholder: false,
            placeholder: '<li class="placeholder">',
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
                    } else if (item.children('ol').size() < 1) {
                        item.append('<ol></ol>');
                    }

                    _super(item)
                });

                /**
                 * Flatten any multi level children.
                 */
                console.log(targetContainer.el.get(0) !== $('#selected_pages').get(0));
                if (targetContainer.el.get(0) !== $('#selected_pages').get(0)) {
                    console.log('ASDASD');
                    item.find("li").detach().appendTo(item.parent());
                }

                jsonObj = [];

                $("#selected_pages").children('li').each(function (index, element) {
                    if ($(element).clone().children().remove().end().text().trim()) {

                        parent = getJsonElement(element, true);

                        $(element).find('ol').children('li').each(function (subIndex, subElement) {
                            subTmp = {}

                            if ($(subElement).clone().children().remove().end().text().trim()) {
                                child = getJsonElement(subElement);
                                parent["children"].push(child);
                            }
                        });

                        jsonObj.push(parent);
                    }
                });

                $('#Form-field-Parallaxes-pages').val(JSON.stringify(jsonObj));
            },
            onDragStart: function ($item, container, _super) {
            var offset = $item.offset();
                pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                }

                _super($item, container);
            },
            onDrag: function ($item, position, _super, event) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
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
        return $(element).clone().children().remove().end().text().trim();
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

    that.init();
    return that;
};
