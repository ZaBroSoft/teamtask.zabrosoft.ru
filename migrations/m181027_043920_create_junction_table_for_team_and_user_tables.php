<?php

use yii\db\Migration;

/**
 * Handles the creation of table `team_user`.
 * Has foreign keys to the tables:
 *
 * - `team`
 * - `user`
 */
class m181027_043920_create_junction_table_for_team_and_user_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('team_user', [
            'team_id' => $this->integer(),
            'user_id' => $this->integer(),
            'PRIMARY KEY(team_id, user_id)',
        ]);

        // creates index for column `team_id`
        $this->createIndex(
            'idx-team_user-team_id',
            'team_user',
            'team_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-team_user-team_id',
            'team_user',
            'team_id',
            'team',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-team_user-user_id',
            'team_user',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-team_user-user_id',
            'team_user',
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
        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-team_user-team_id',
            'team_user'
        );

        // drops index for column `team_id`
        $this->dropIndex(
            'idx-team_user-team_id',
            'team_user'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-team_user-user_id',
            'team_user'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-team_user-user_id',
            'team_user'
        );

        $this->dropTable('team_user');
    }
}
