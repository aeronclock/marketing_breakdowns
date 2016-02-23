<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\Expression;
use app\models\BreakdownColor;

/**
 * This is the model class for table "breakdown_details".
 *
 * @property integer $id
 * @property integer $breakdown_color_id
 * @property integer $breakdown_id
 * @property string $hangtag
 * @property double $unit_quantity
 * @property string $code
 * @property double $quantity
 * @property double $allowance
 * @property string $excel_file
 * @property string $created_at
 * @property integer $created_by
 *
 * @property BreakdownColors $breakdownColor
 * @property Breakdowns $breakdown
 */
class BreakdownDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'breakdown_details';
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
    public function rules()
    {
        return [
            [['breakdown_color_id', 'breakdown_id', 'created_by'], 'integer'],
            [['unit_quantity', 'quantity', 'allowance'], 'number'],
            [['excel_file'], 'file', 'skipOnEmpty' => true],
            [['created_at'], 'safe'],
            [['hangtag', 'code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'breakdown_color_id' => Yii::t('app', 'Breakdown Color ID'),
            'breakdown_id' => Yii::t('app', 'Breakdown ID'),
            'hangtag' => Yii::t('app', 'Hangtag'),
            'unit_quantity' => Yii::t('app', 'Unit Quantity'),
            'code' => Yii::t('app', 'Code'),
            'quantity' => Yii::t('app', 'Quantity'),
            'allowance' => Yii::t('app', 'Allowance'),
            'excel_file' => Yii::t('app', 'Excel File'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreakdownColor()
    {
        return $this->hasOne(BreakdownColor::className(), ['id' => 'breakdown_color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBreakdown()
    {
        return $this->hasOne(Breakdown::className(), ['id' => 'breakdown_id']);
    }
}
