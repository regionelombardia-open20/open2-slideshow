<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\slideshow
 * @category   CategoryName
 */

namespace open20\amos\slideshow\assets;

use yii\web\AssetBundle;

/**
 * Class ModuleSlideshowAsset
 * @package open20\amos\slideshow\assets
 */
class ModuleSlideshowAsset extends AssetBundle
{
    public $sourcePath = '@vendor/open20/amos-slideshow/src/assets/web';

    public $css = [
        'less/slideshow.less'
    ];
    public $js = [        
    ];
    public $depends = [
    ];

    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');
        if(!empty($moduleL))
        { $this->depends [] = 'open20\amos\layout\assets\BaseAsset'; }
        else
        { $this->depends [] = 'open20\amos\core\views\assets\AmosCoreAsset'; }
        parent::init(); // TODO: Change the autogenerated stub
    }
}
