<?php

use yii\grid\SerialColumn;
use common\models\Project;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ProjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Proyecto', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'created_at',
            'updated_at',
            //'created_by',
            [
                'attribute' =>'updated_by',
                'value' => static function($model)
                {
                    return User::findOne($model->updated_by)->username;
                },
                'filter' => ArrayHelper::map(User::find()->all(),'id','nombre'),
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => static function ($action, Project $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]) ?>


</div>
