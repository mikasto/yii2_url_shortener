<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%urls}}`.
 */
class m240718_205835_create_urls_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%urls}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(2048)->notNull(),
            'short' => $this->string(5)->notNull(),
            'created' => $this->timestamp(),
        ]);

        $this->createIndex(
            'idx-urls-short',
            '{{%urls}}',
            'short'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-urls-short',
            '{{%urls}}'
        );
        $this->dropTable('{{%urls}}');
    }
}
