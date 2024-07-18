<?php

namespace app\models;

/**
 * This is the model class for table "urls".
 *
 * @property int $id
 * @property string $url
 * @property string $short
 * @property string|null $created
 */
class Url extends \yii\db\ActiveRecord
{
    const SHORT_LINK_LENGTH = 5;
    const TRY_GENERATE_LIMIT = 500;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'urls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'short'], 'required'],
            [['created'], 'safe'],
            [['url'], 'string', 'max' => 2048],
            [['url'], 'url', 'defaultScheme' => 'http'],
            [['short'], 'string', 'max' => self::SHORT_LINK_LENGTH],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'short' => 'Short',
            'created' => 'Created',
        ];
    }

    public function beforeValidate()
    {
        $this->short = $this->generateShortString();
        $this->created = date('YmdHis');
        return true;
    }

    private function generateShortString()
    {
        $try = 0;
        $range = array_merge(
            range('a', 'z'),
            range('A', 'Z'),
            range(0, 9),
            ['_', '-']
        );
        do {
            $s = '';
            for ($i = 0; $i < self::SHORT_LINK_LENGTH; $i++) {
                $s .= $range[mt_rand(0, count($range) - 1)];
            }
            if (++$try > self::TRY_GENERATE_LIMIT) {
                throw new \yii\web\ServerErrorHttpException('Try again please');
            }
        } while (!is_null(Url::findOne(['short' => $s])));
        return $s;
    }
}
