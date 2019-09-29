<?php

use app\models\Advertisement;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var Advertisement $ad
 * @var View $this
 */

$this->title = 'Create ad';
?>

<h2>Create ad</h2>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($ad, 'firstName') ?>
<?= $form->field($ad, 'lastName') ?>
<?= $form->field($ad, 'email') ?>
<?= $form->field($ad, 'phone') ?>
<?= $form->field($ad, 'title') ?>
<?= $form->field($ad, 'description') ?>
<?= Html::submitButton('Create') ?>
<?php ActiveForm::end() ?>
