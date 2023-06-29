<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProjectUser $model */

$this->title = 'Actualizar Integrante del Proyecto: ' . $model->project->name;
$this->params['breadcrumbs'][] = ['label' => 'Asignación de Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['view', 'project_id' => $model->project_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="project-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
