<?php
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
?>
<?php namespace Freestream\Parallax\Components;

use Cms\Classes\ComponentBase;
use Freestream\Parallax\Models\Parallaxes;

class Parallax extends ComponentBase
{
    /**
     * Page Collection array;
     *
     * @var array
     */
    protected $_pageCollection = [];

    /**
     * Component Description.
     *
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Parallax Page',
            'description' => 'Generates a parallax of selected pages'
        ];
    }

    /**
     * Component Configuration Properties.
     *
     * @return array
     */
    public function defineProperties()
    {
        return [
            'parallax' => [
                'title'             => 'Parallax',
                'description'       => 'Parallax page collection',
                'type'              => 'dropdown',
                'default'           => ''
            ],
            'verticalCentered' => [
                'title'             => 'Vertical Centered',
                'description'       => 'Vertically centering of the content within sections',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => 'General',
            ],
            'resize' => [
                'title'             => 'Resize',
                'description'       => 'Whether you want to resize the text when the window is resized.',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => 'General',
            ],
            'scrollingSpeed' => [
                'title'             => 'Scrolling Speed',
                'description'       => 'Speed in milliseconds for the scrolling transitions.',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid "Scrolling Speed" format.',
                'default'           => '700',
                'group'             => 'General',
            ],
            'menu' => [
                'title'             => 'Menu',
                'description'       => 'A selector can be used to specify the menu to link with the sections. This way the scrolling of the sections will activate the corresponding element in the menu using the class active. This won\'t generate a menu but will just add the active class to the element in the given menu with the corresponding anchor links. In order to link the elements of the menu with the sections, an HTML 5 data-tag (data-menuanchor) will be needed to use with the same anchor links as used within the sections.',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => 'General',
            ],
            'autoScrolling' => [
                'title'             => 'Auto Scrolling',
                'description'       => 'Defines whether to use the "automatic" scrolling or the "normal" one. It also has affects the way the sections fit in the browser/device window in tablets and mobile phones.',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => 'General',
            ],
            'scrollOverflow' => [
                'title'             => 'Scroll Overflow',
                'description'       => 'Defines whether or not to create a scroll for the section in case its content is bigger than the height of it.',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => 'General',
            ],
            'css3' => [
                'title'             => 'CSS3',
                'description'       => 'Defines wheter to use JavaScript or CSS3 transforms to scroll within sections and slides. Useful to speed up the movement in tablet and mobile devices with browsers supporting CSS3. If this option is set to true and the browser doesn\'t support CSS3, a jQuery fallback will be used instead.',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => 'General',
            ],
            'loopBottom' => [
                'title'             => 'Loop Bottom',
                'description'       => 'Defines whether scrolling down in the last section should scroll to the first one or not.',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => 'Looping',
            ],
            'loopTop' => [
                'title'             => 'Loop Top',
                'description'       => 'Defines whether scrolling up in the first section should scroll to the last one or not.',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => 'Looping',
            ],
            'loopHorizontal' => [
                'title'             => 'Loop Horizontal',
                'description'       => 'Defines whether horizontal sliders will loop after reaching the last or previous slide or not.',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => 'Looping',
            ],
            'navigation' => [
                'title'             => 'Menu',
                'description'       => 'Will show a navigation bar made up of small circles.',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => 'Navigation',
            ],
            'navigationPosition' => [
                'title'             => 'Navigation Position',
                'description'       => 'It can be set to left or right and defines which position the navigation bar will be shown (if using one)',
                'type'              => 'dropdown',
                'default'           => 'right',
                'group'             => 'Navigation',
                'options'               => [
                    'right'             => 'Right',
                    'left'              => 'Left'
                ]
            ],
            'slidesNavigation' => [
                'title'             => 'Slides Navigation',
                'description'       => 'If set to true it will show a navigation bar made up of small circles for each landscape slider on the site.',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => 'Slides Navigation',
            ],
            'slidesNavPosition' => [
                'title'             => 'Sides Navigation Position',
                'description'       => 'Defines the position for the landscape navigation bar for sliders. Admits top and bottom as values. You may want to modify the CSS styles to determine the distance from the top or bottom as well as any other style such as color.',
                'type'              => 'dropdown',
                'default'           => 'bottom',
                'group'             => 'Slides Navigation',
                'options'               => [
                    'bottom'            => 'Bottom',
                    'top'               => 'Top',
                ]
            ],
            'paddingTop' => [
                'title'             => 'Padding Top',
                'description'       => 'Defines the top padding for each section with a numerical value and its measure. Useful in case of using a fixed header.',
                'type'              => 'string',
                'validationPattern' => '^([0]|[\d]+(\s)?(em|px|\%))$',
                'validationMessage' => 'Must be number with a tailing size option (em, px or %)',
                'default'           => '0',
                'group'             => 'Advanced',
            ],
            'paddingBottom' => [
                'title'             => 'Padding Bottom',
                'description'       => 'Defines the bottom padding for each section with a numerical value and its measure. Useful in case of using a fixed footer.',
                'type'              => 'string',
                'validationPattern' => '^([0]|[\d]+(\s)?(em|px|\%))$',
                'validationMessage' => 'Must be number with a tailing size option (em, px or %)',
                'default'           => '0',
                'group'             => 'Advanced',
            ],
            'fixedElements' => [
                'title'             => 'Fixed Elements',
                'description'       => 'Defines which elements will be taken off the scrolling structure of the plugin which is necesary when using the css3 option to keep them fixed. It requires a string with the jQuery selectors for those elements.',
                'type'              => 'string',
                'default'           => '',
                'group'             => 'Advanced',
            ],
            'normalScrollElements' => [
                'title'             => 'Normal Scroll Elements',
                'description'       => 'If you want to avoid the auto scroll when scrolling over some elements, this is the option you need to use. (useful for maps, scrolling divs etc.) It requires a string with the jQuery selectors for those elements.',
                'type'              => 'string',
                'default'           => '',
                'group'             => 'Advanced',
            ],
            'normalScrollElementTouchThreshold' => [
                'title'             => 'Normal Scroll Element Touch Threshold',
                'description'       => 'Defines the threshold for the number of hops up the html node tree Fullpage will test to see if "Normal Scroll Elements" is a match to allow scrolling functionality on divs on a touch device.',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid "Normal Scroll Element Touch Threshold" format.',
                'default'           => '5',
                'group'             => 'Advanced',
            ],
            'keyboardScrolling' => [
                'title'             => 'Keyboard Scrolling',
                'description'       => 'Defines if the content can be navigated using the keyboard.',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => 'Advanced',
            ],
            'touchSensitivity' => [
                'title'             => 'Touch Sensitivity',
                'description'       => 'Defines a percentage of the browsers window width/height, and how far a swipe must measure for navigating to the next section / slide.',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid "Touch Sensitivity" format.',
                'default'           => '5',
                'group'             => 'Advanced',
            ],
            'continuousVertical' => [
                'title'             => 'Continuous Vertical',
                'description'       => 'Defines whether scrolling down in the last section should scroll down to the first one or not, and if scrolling up in the first section should scroll up to the last one or not. Not compatible with "Loop Top" or "Loop Bottom"',
                'type'              => 'checkbox',
                'default'           => 'no',
                'group'             => 'Advanced',
            ],
            'animateAnchor' => [
                'title'             => 'Animate Anchor',
                'description'       => 'Defines whether the load of the site when given an anchor (#) will scroll with animation to its destination or will directly load on the given section.',
                'type'              => 'checkbox',
                'default'           => 'yes',
                'group'             => 'Advanced',
            ],
        ];
    }

    /**
     * Option array with all parallaxes.
     */
    public function getParallaxOptions()
    {
        return Parallaxes::all()->lists('title', 'id');
    }

    /**
     * Initial run event.
     */
    public function onRun()
    {
        /**
         * Required library.
         */
        $this->addJs('/plugins/freestream/parallax/assets/js/jquery.easings.min.js');
        $this->addJs('/plugins/freestream/parallax/assets/js/jquery.slimscroll.min.js');
        $this->addJs('/plugins/freestream/parallax/assets/js/jquery.fullPage.min.js');

        /**
         * Custom styling.
         */
        $this->addJs('/plugins/freestream/parallax/assets/js/parallax.js');
        $this->addCss('/plugins/freestream/parallax/assets/css/parallax.css');
    }

   /**
     * Build all my parameters for the view
     */
    public function onRender()
    {
        $model = new Parallaxes;
        $this->page['pages'] = $this->_getPageCollection();

        foreach ($this->getProperties() as $key => $value) {
            $this->page[$key] = $value;
        }

        $this->page['navigationTooltips']   = json_encode($this->getNavigationTooltips());
        $this->page['anchors']              = json_encode($this->getAnchors());
    }

    /**
     * Retrieves all pages from the current parallax.
     *
     * @return array
     */
    protected function _getPageCollection()
    {
        if (!$this->_pageCollection) {
            $model = new Parallaxes;
            $this->_pageCollection = $model->getPageCollection($this->property('parallax'), $this->page->id);
        }

        return $this->_pageCollection;
    }

    /**
     * Returns all page names from the current parallax.
     *
     * @return array
     */
    protected function getAnchors()
    {
        $model = new Parallaxes;
        $pages = [];

        foreach ($this->_getPageCollection() as $page) {
            $pages[] = $page['pagename'];
        }

        return $pages;
    }

    /**
     * Returns all page titles from the current parallax.
     *
     * @return array
     */
    protected function getNavigationTooltips()
    {
        $model = new Parallaxes;
        $pages = [];

        foreach ($this->_getPageCollection() as $page) {
            $pages[] = $page['title'];
        }

        return $pages;
    }
}