<?php

namespace app\models;

use yii\base\Exception;
use yii\base\Security;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "urls".
 *
 * @property int $id
 * @property string $url
 * @property string $short
 * @property int $created
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
            [['url', 'short', 'created'], 'required'],
            [['created'], 'numeric'],
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
            'url' => 'Original Url',
            'short' => 'Short URL',
            'created' => 'Created Unix Datetime',
        ];
    }

    /**
     * Auto prepare model for validate and save
     * @return bool
     * @throws ServerErrorHttpException
     */
    public function beforeValidate()
    {
        $this->generateShortUrl();
        $this->created = time();
        return true;
    }

    /**
     * Short URL field generation
     * @throws Exception
     * @throws ServerErrorHttpException
     */
    private function generateShortUrl()
    {
        if (!is_null($this->short)) {
            return;
        }

        $try = 0;
        do {
            $s = (new Security)->generateRandomString(self::SHORT_LINK_LENGTH);
            if (++$try > self::TRY_GENERATE_LIMIT) {
                throw new ServerErrorHttpException('Try again please');
            }
        } while (!is_null(Url::findOne(['short' => $s])));
        $this->short = $s;
    }
}
