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
        $this->execute(
            "CREATE TABLE `urls` (
                    `id` int NOT NULL AUTO_INCREMENT,
                    `url` varchar(2048) NOT NULL,
                    `short` varchar(5) NOT NULL,
                    `created` int NOT NULL,
                PRIMARY KEY (`id`),
                KEY `idx-urls-short` (`short`)
                ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs
                "
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
