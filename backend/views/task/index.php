<?php

use common\models\Project;
use yii\grid\SerialColumn;
use common\models\Task;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

// Models
use common\models\Status;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\search\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tareas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Tarea', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'class' => ActionColumn::class,
                'urlCreator' => static function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]) ?>

</div>

