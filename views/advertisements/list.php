<?php

use app\models\Advertisement;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var Advertisement[] $ads
 * @var View            $this
 */

$this->title = 'Ads list';
?>
<h2>Advertisements list</h2>

<?= Html::a('Create ad', ['advertisements/create']) ?>

<?php foreach ($ads as $ad): ?>
<div>
    <h3>
        <?= Html::a($ad->title, ['advertisements/view', 'id' => $ad->id]) ?>
    </h3>
    <?= Html::a('Edit', ['advertisements/update', 'id' => $ad->id]) ?>
    <div>
        <b><?= $ad->firstName ?> <?= $ad->lastName ?></b>
    </div>
    <div><?= $ad->description ?></div>
</div>
<?php endforeach; ?>
