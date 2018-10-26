<?php

use yii\db\Migration;

/**
 * Handles the creation of table `team`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m181026_102117_create_team_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('team', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'description' => $this->string(),
            'content' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'date_at' => $this->date(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-team-user_id',
            'team',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-team-user_id',
            'team',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-team-user_id',
            'team'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-team-user_id',
            'team'
        );

        $this->dropTable('team');
    }
}
