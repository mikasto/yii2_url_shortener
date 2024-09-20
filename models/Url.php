<?php

namespace app\models;

use yii\base\Exception;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "urls".
 *
 * @property int $id
 * @property string $url
 * @property string $short
 * @property int $created
 */
class Url extends ActiveRecord
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
            [['url', 'short', 'created'], 'required'],
            [['created'], 'integer'],
            [['url'], 'string', 'max' => 2048],
            [['url'], 'url', 'defaultScheme' => 'http'],
            [['short'], 'string', 'max' => self::SHORT_LINK_LENGTH],
            [['short'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Original Url',
            'short' => 'Short URL',
            'created' => 'Created Unix Datetime',
        ];
    }

    /**
     * Auto prepare model for validate and save
     * @return bool
     */
    public function prepare()
    {
        $this->created = time();
        return $this->generateShortUrl();
    }

    /**
     * Short URL field generation
     * @return bool
     */
    private function generateShortUrl()
    {
        if (!is_null($this->short)) {
            return false;
        }

        $try = 0;
        do {
            try {
                $s = (new Security)->generateRandomString(self::SHORT_LINK_LENGTH);
            } catch (\Throwable $e) {
                return false;
            }
            if (++$try > self::TRY_GENERATE_LIMIT) {
                return false;
            }
        } while (!is_null(Url::findOne(['short' => $s])));
        $this->short = $s;
        return true;
    }
}
