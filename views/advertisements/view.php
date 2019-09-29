<?php


use app\models\Advertisement;
use yii\web\View;

/**
 * @var Advertisement $ad
 * @var View          $this
 */

$this->title = $ad->title . ' by ' . $ad->firstName . ' ' . $ad->lastName;
?>
<h2><?= $ad->title ?></h2>

<div>
    <div>
        <b><?= $ad->firstName ?> <?= $ad->lastName ?></b>
    </div>
    <div><?= $ad->description ?></div>
</div>
