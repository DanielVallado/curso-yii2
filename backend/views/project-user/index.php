<?php

use common\models\Project;
use common\models\Role;
use common\models\User;
use yii\grid\SerialColumn;
use common\models\ProjectUser;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ProjectUserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Asignación de Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Asignar Proyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            [
                'attribute' =>'project_id',
                'value' => static function($model)
                {
                    return Project::findOne($model)->name;
                },
                'filter' => ArrayHelper::map(Project::find()->all(),'id','name'),
            ],
            [
                'attribute' =>'project_id',
                'value' => static function($model)
                {
                    return User::findOne($model)->username;
                },
                'filter' => ArrayHelper::map(User::find()->all(),'id','username'),
            ],
            [
                'attribute' =>'role_id',
                'value' => static function($model)
                {
                    return Role::findOne($model)->nombre;
                },
                'filter' => ArrayHelper::map(Role::find()->all(),'id','nombre'),
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, ProjectUser $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'project_id' => $model->project_id, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ])   ?>


</div>
