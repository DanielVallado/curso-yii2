<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Status $model */

$this->title = 'Actualizar Estatus: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estatus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
