<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

use lispa\amos\core\migration\AmosMigrationWidgets;
use lispa\amos\dashboard\models\AmosWidgets;

class m161028_130926_add_slideshow_widgets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'slideshow';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \lispa\amos\slideshow\widgets\icons\WidgetIconSlideshow::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
            [
                'classname' => \lispa\amos\slideshow\widgets\icons\WidgetIconSlideshowConf::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'child_of' => lispa\amos\slideshow\widgets\icons\WidgetIconSlideshow::className(),
                'status' => AmosWidgets::STATUS_ENABLED
            ],
        ];
    }
}