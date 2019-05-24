<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

use lispa\amos\core\utilities\ViewUtility;

use lispa\amos\slideshow\AmosSlideshow;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var lispa\amos\slideshow\models\SlideshowRoute $model
 */

$this->title = $model->route;
$this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow Route'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slideshow-route-view col-xs-12">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'route',
            'already_view',
            'slideshow_id',
            ['attribute' => 'created_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
            ['attribute' => 'updated_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
            ['attribute' => 'deleted_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
            'created_by',
            'updated_by',
            'deleted_by',
        ],
    ]) ?>

    <div class="btnViewContainer pull-right">
        <?= Html::a(AmosSlideshow::t('amosslideshow', 'Chiudi'), Url::previous(), ['class' => 'btn btn-secondary']); ?>
    </div>
</div>
