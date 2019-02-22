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
 * @var lispa\amos\slideshow\models\Slideshow $model
 */
use lispa\amos\slideshow\AmosSlideshow;

$this->title = AmosSlideshow::t('amosslideshow', 'Aggiorna');
$this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow'), 'url' => ['/slideshow']];
$this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Elenco'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosSlideshow::t('amosslideshow', 'Aggiorna');
?>
<div class="slideshow-update">
    <?= $this->render('_form', [
        'model' => $model,
        'route' => $route
    ]) ?>
</div>
