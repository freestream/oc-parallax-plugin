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
<?php namespace Freestream\Parallax\Models;

use Model;
use BackendAuth;
use Cms\Classes\Router;
use Cms\Classes\Theme;
use Cms\Classes\Controller;

/**
 * Parallaxes Model
 */
class Parallaxes extends Model
{
    /**
     * Required for validation.
     */
    use \October\Rain\Database\Traits\Validation;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'freestream_parallax_parallaxes';

    /**
     * Guarded fields.
     *
     * @var array
     */
    protected $guarded = ['*'];

    /**
     * Controller model.
     *
     * @var Cms\Classes\Controller
     */
    protected $_controller;

    /**
     * Router model.
     *
     * @var Cms\Classes\Router
     */
    protected $_router;

    /**
     * Requested fields.
     *
     * @var array
     */
    public $rules = [
        'title' => 'required',
        'pages' => 'required',
    ];

    /**
     * Returns an array collection of all parallax pages.
     *
     * @param  integer       $parallaxId
     * @param  array|string  $skipPages
     *
     * @return array
     */
    public function getPageCollection($parallaxId, $skipPages = [])
    {
        if (!is_array($skipPages)) {
            $skipPages = [$skipPages];
        }

        $parallax = Parallaxes::find($parallaxId);

        if (!$parallax || !$parallax->pages) {
            return [];
        }

        $pages = json_decode($parallax->pages, true);

        if (!$pages) {
            $pages = [];
        }

        $collection = [];

        foreach ($pages as $parent) {
            if (in_array($parent['pagename'], $skipPages) || $this->_isPageHidden($parent['pagename'])) {
                continue;
            }

            $tempParent = [
                'title'     => $parent['title'],
                'pagename'  => $parent['pagename'],
                'html'      => $this->_getHtmlFromFilename($parent['pagename']),
                'url'       => $this->_getUrlFromFilename($parent['pagename']),
                'children'  => [],
            ];

            if (is_array($parent['children'])) {
                foreach ($parent['children'] as $child) {
                    if (in_array($child['pagename'], $skipPages) || $this->_isPageHidden($child['pagename'])) {
                        continue;
                    }

                    $tempChild = [
                        'title'     => $child['title'],
                        'pagename'  => $child['pagename'],
                        'html'      => $this->_getHtmlFromFilename($child['pagename']),
                        'url'       => $this->_getUrlFromFilename($child['pagename'])
                    ];

                    $tempParent['children'][] = $tempChild;
                }
            }

            $collection[] = $tempParent;
        }

        return $collection;
    }

    /**
     * Returns page content from filename.
     *
     * @param  string $fileName
     *
     * @return string
     */
    protected function _getHtmlFromFilename($fileName)
    {
        return $this->_getController()->run($this->_getUrlFromFilename($fileName))->original;
    }

    /**
     * Returns page URL from filename.
     *
     * @param  string $fileName
     *
     * @return string
     */
    protected function _getUrlFromFilename($fileName)
    {
        return $this->_getRouter()->findByFile($fileName);
    }

    /**
     * Checks if a page exists and that it is not hidden.
     *
     * @param  string  $fileName
     *
     * @return boolean
     */
    protected function _isPageHidden($fileName)
    {
        $page = $this->_getRouter()->findByUrl($this->_getUrlFromFilename($fileName));

        if (!$page || ($page && $page->hidden && !BackendAuth::getUser())) {
            return true;
        }

        return false;
    }

    /**
     * Returns controller model.
     *
     * @return Cms\Classes\Controller
     */
    protected function _getController()
    {
        if (!$this->_controller) {
            $this->_controller = new Controller();
        }

        return $this->_controller;
    }

    /**
     * Returns router model.
     *
     * @return Cms\Classes\Router
     */
    protected function _getRouter()
    {
        if (!$this->_router) {
            $this->_router = new Router(Theme::getActiveTheme());
        }

        return $this->_router;
    }
}
