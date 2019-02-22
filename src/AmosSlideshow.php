<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

namespace lispa\amos\slideshow;

use lispa\amos\core\module\AmosModule;
use lispa\amos\core\module\ModuleInterface;
use lispa\amos\slideshow\widgets\icons\WidgetIconSlideshow;
use lispa\amos\slideshow\widgets\icons\WidgetIconSlideshowConf;
use Yii;

/**
 * Class AmosSlideshow
 * @package lispa\amos\slideshow
 */
class AmosSlideshow extends AmosModule implements ModuleInterface
{
    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';
    public $name = 'Slideshow';

    public static function getModuleName()
    {
        return "slideshow";
    }

    public function init()
    {
        parent::init();
        
        \Yii::setAlias('@lispa/amos/' . static::getModuleName() . '/controllers/', __DIR__ . '/controllers/');
        // initialize the module with the configuration loaded from config.php
        Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php'));
    }

    public function getWidgetIcons()
    {
        return [
            WidgetIconSlideshow::className(),
            WidgetIconSlideshowConf::className(),
        ];
    }

    public function getWidgetGraphics()
    {
        return [];
    }

    protected function getDefaultModels()
    {

    }

}
