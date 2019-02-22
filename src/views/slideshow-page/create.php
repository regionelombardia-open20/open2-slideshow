<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

/**
 * @var yii\web\View $this
 * @var lispa\amos\slideshow\models\SlideshowPage $model
 */

use lispa\amos\slideshow\AmosSlideshow;

$this->title = AmosSlideshow::t('amosslideshow', 'Crea');/*
$this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow'), 'url' => ['/slideshow']];
if (isset($model->slideshow_id)) {
    $this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Elenco'), 'url' => ['index', 'slideshowId' => $model->slideshow_id]];
    $this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Pagine'), 'url' => ['/slideshow/slideshow-page/index', 'slideshowId' => $model->slideshow_id]];
}
$this->params['breadcrumbs'][] = AmosSlideshow::t('amosslideshow', 'Crea');*/
?>
<div class="slideshow-pages-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
