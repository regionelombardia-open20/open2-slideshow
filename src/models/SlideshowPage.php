<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

namespace lispa\amos\slideshow\models;

/**
 * Class SlideshowPage
 * @package lispa\amos\slideshow\models
 *
 * This is the model class for table "slideshow_pages".
 */
class SlideshowPage extends \lispa\amos\slideshow\models\base\SlideshowPage
{
    public function representingColumn(){
        return [
            'name',
        ];
    }
}

