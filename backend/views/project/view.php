<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

// Models
use common\models\Project;
use common\models\Status;
use common\models\Task;

/** @var yii\web\View $this */
/** @var common\models\Project $model */
/** @var common\models\search\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar el proyecto "' . $model->name . '"?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'description:text',
            'created_at',
            'updated_at',
            [
                'attribute' => 'created_by',
                'value' => $model->getUsername($model->created_by)
            ],
            [
                'attribute' => 'updated_by',
                'value' => $model->getUsername($model->updated_by)
            ],
        ],
    ]) ?>

    <!-- Sección de tareas -->
    <p class="d-inline-block">
        <!--<?= Html::a('Crear Tarea', ['create'], ['class' => 'btn btn-success']) ?>-->
        <?= Html::a('Crear tarea',['task/create', 'project_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <!-- Botón para añadir colaborador de proyecto -->
    <p class="d-inline-block">
        <!--<?= Html::a('Crear Tarea', ['create'], ['class' => 'btn btn-success']) ?>-->
        <?= Html::a('Asignar integrante',['project-user/create', 'project_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            //'id',
            'name',
            'description:ntext',
            [
                'attribute' =>'project_id',
                'value' => static function($model)
                {
                    return Project::findOne($model)->name;
                },
                'filter' => ArrayHelper::map(Project::find()->all(),'id','name'),
            ],
            [
                'attribute' =>'status_id',
                'value' => static function($model)
                {
                    return Status::findOne($model)->description;
                },
                'filter' => ArrayHelper::map(Status::find()->all(),'id','description'),
            ],
            //'status_id',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //[
            //    'class' => ActionColumn::class,
            //    'urlCreator' => static function ($action, Task $model, $key, $index, $column) {
            //        return Url::toRoute([$action, 'id' => $model->id]);
            //    }
            //],
            ['class' => ActionColumn::class,'controller' => 'task','template' => '{view} {update} {delete}'],
        ],
    ]) ?>

</div>

