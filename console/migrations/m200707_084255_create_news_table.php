<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%authors}}`
 */
class m200707_084255_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'description' => $this->string(50)->notNull(),
            'text' => $this->text()->notNull(),
            'title' => $this->string(20),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-news-author_id}}',
            '{{%news}}',
            'author_id'
        );

        // add foreign key for table `{{%authors}}`
        $this->addForeignKey(
            '{{%fk-news-author_id}}',
            '{{%news}}',
            'author_id',
            '{{%authors}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%authors}}`
        $this->dropForeignKey(
            '{{%fk-news-author_id}}',
            '{{%news}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-news-author_id}}',
            '{{%news}}'
        );

        $this->dropTable('{{%news}}');
    }
}
