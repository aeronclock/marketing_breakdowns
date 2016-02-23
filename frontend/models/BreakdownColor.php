<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "breakdown_colors".
 *
 * @property integer $id
 * @property integer $breakdown_id
 * @property string $color_name
 * @property string $excel_file
 * @property string $created_at
 * @property integer $created_by
 */
class BreakdownColor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'breakdown_colors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['breakdown_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['color_name'], 'string', 'max' => 255]
        ];
    }
    
    public function behaviors()
    {
      return [
        [
            'class' => '\yiidreamteam\upload\FileUploadBehavior',
            'attribute' => 'excel_file',
            'filePath' => '@webroot/uploads/[[pk]].[[extension]]',
            'fileUrl' => '/uploads/[[pk]].[[extension]]',
        ],
      ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'breakdown_id' => Yii::t('app', 'Breakdown ID'),
            'color_name' => Yii::t('app', 'Color Name'),
            'excel_file' => Yii::t('app', 'Excel File'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }
    
    public function getBreakdown()
    {
        return $this->hasOne(Breakdown::className(), ['id' => 'breakdown_id']);
    }
}
