<?php

use common\models\Project;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

// Models
use common\models\Status;

/** @var yii\web\View $this */
/** @var common\models\Task $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'description:ntext',
            [
                'attribute' =>'project_id',
                'value' => $model->project->name,
                'filter' => ArrayHelper::map(Project::find()->all(),'id','name'),
            ],
            [
                'attribute' =>'status_id',
                'value' => $model->status->description,
                'filter' => ArrayHelper::map(Status::find()->all(),'id','description'),
            ],
            'created_at',
            'updated_at',
            [
                'attribute' => 'created_by',
                'value' => $model->getUsername($model->updated_by)
            ],
            [
                'attribute' => 'updated_by',
                'value' => $model->getUsername($model->updated_by)
            ],
        ],
    ]) ?>

</div>

