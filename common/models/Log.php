<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property integer $log_id
 * @property string $username
 * @property integer $scid
 * @property string $sdate
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['scid'], 'integer'],
            [['sdate','scid'], 'safe'],
            [['username'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'username' => 'Username',
            'scid' => 'เลขบัตรประชาชนที่ค้นหา',
            'sdate' => 'DateTime',
        ];
    }
}
