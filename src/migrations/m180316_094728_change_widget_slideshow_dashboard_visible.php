<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow\migrations
 * @category   CategoryName
 */

use lispa\amos\core\migration\AmosMigrationWidgets;

/**
 * Class m180316_094728_change_widget_slideshow_dashboard_visible
 */
class m180316_094728_change_widget_slideshow_dashboard_visible extends AmosMigrationWidgets
{
    const MODULE_NAME = 'documenti';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \lispa\amos\slideshow\widgets\icons\WidgetIconSlideshowConf::className(),
                'dashboard_visible' => 1,
                'update' => true
            ]
        ];
    }
}
