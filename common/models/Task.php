<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $project_id
 * @property int $status_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Project $project
 * @property Status $status
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'project_id', 'status_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['description'], 'string'],
            [['project_id', 'status_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'project_id' => 'Proyecto ID',
            'status_id' => 'Estatus ID',
            'created_at' => 'Creado En',
            'updated_at' => 'Actualizado En',
            'created_by' => 'Creado Por',
            'updated_by' => 'Actualizado Por',
        ];
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
}
