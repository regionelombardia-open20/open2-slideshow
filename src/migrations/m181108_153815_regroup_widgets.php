<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\admin\migrations
 * @category   CategoryName
 */

use lispa\amos\admin\models\UserProfileArea;
use yii\db\Migration;

/**
 * Class m181012_162615_add_user_profile_area_field_1
 */
class m181108_153815_regroup_widgets extends Migration
{



    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update('amos_widgets', ['child_of' => 'lispa\amos\dashboard\widgets\icons\WidgetIconManagement'], ['classname' => 'lispa\amos\slideshow\widgets\icons\WidgetIconSlideshowConf']);

        $this->update('amos_widgets', ['status' => 0], ['classname' => 'lispa\amos\slideshow\widgets\icons\WidgetIconSlideshow']);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->update('amos_widgets', ['child_of' => null], ['classname' => 'lispa\amos\slideshow\widgets\icons\WidgetIconSlideshowConf']);
        $this->update('amos_widgets', ['status' => 1], ['classname' => 'lispa\amos\slideshow\widgets\icons\WidgetIconSlideshow']);

    }
}
