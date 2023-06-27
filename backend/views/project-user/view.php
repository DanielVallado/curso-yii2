<?php

use common\models\Project;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ProjectUser $model */

$this->title = $model->project->name;
$this->params['breadcrumbs'][] = ['label' => 'Asignación de Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'project_id' => $model->project_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'project_id' => $model->project_id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' =>'project_id',
                'value' => $model->project->name,
                'filter' => ArrayHelper::map(Project::find()->all(),'id','name'),
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username
            ],
            [
                'attribute' => 'role_id',
                'value' => $model->role->nombre
            ],
        ],
    ]) ?>

</div>
