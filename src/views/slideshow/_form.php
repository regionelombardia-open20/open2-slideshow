<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

use lispa\amos\core\forms\ActiveForm;
use lispa\amos\core\forms\CloseSaveButtonWidget;
use lispa\amos\core\forms\CreatedUpdatedWidget;
use lispa\amos\core\forms\Tabs;
use lispa\amos\slideshow\AmosSlideshow;
use kartik\widgets\Select2;


/**
 * @var yii\web\View $this
 * @var lispa\amos\slideshow\models\Slideshow $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="slideshow-form col-xs-12">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?php $this->beginBlock('generale'); ?>
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-sm-6">
            
            <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?=
            $form->field($route, 'role')->widget(Select2::classname(), [
                'data' => $route->getAllRoles(),
                'options' => ['placeholder' => AmosSlideshow::t('amosslideshow', 'Selezionare i ruoli che vedranno lo slideshow ...'), 'id' => 'role-id'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-sm-8">
            <?=
            $form->field($route, 'route')->widget(Select2::classname(), [
                'data' => $route->getRotte(($model->isNewRecord) ? '' : $model->id),
                'options' => ['placeholder' => AmosSlideshow::t('amosslideshow', 'Seleziona ...')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
            <?php /*
                $form->field($route, 'route')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'data' => ($model->isNewRecord ? [] : ['id' => '/tag', 'name' => '/tag']),
                    'options' => ['id' => 'route-id', 'disabled' => FALSE],
                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                    'pluginOptions' => [
                        'depends' => [(FALSE) ?: 'role-id'],
                        'placeholder' => [AmosSlideshow::t('amosslideshow', 'Seleziona ...')],
                        'url' => Url::to(['/slideshow/slideshow/route-by-role']),
                        'initialize' => true,
                        'params' => ['route-id'],
                    ],
                ]);*/
            ?>
        </div>
        <div class="col-lg-3 col-sm-4">
            
            <?= $form->field($route, 'already_view')->dropdownList([0 => 'NO', 1 => 'SI']) ?>
        </div>
    </div>
    <div class="row">

    </div>

    <div class="clearfix"></div>
    <?php $this->endBlock('generale'); ?>
    
    <?php
    $itemsTab[] = [
        'label' => AmosSlideshow::tHtml('amosslideshow', 'Generale '),
        'content' => $this->blocks['generale'],
    ];
    ?>
    
    <?= Tabs::widget([
        'encodeLabels' => false,
        'items' => $itemsTab
    ]); ?>
    <div class="col-xs-12 note_asterisk nop">
        <p>I campi <span class="red">*</span> sono obbligatori.</p>
    </div>
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
