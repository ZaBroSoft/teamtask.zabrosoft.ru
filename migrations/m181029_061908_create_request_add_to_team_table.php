<?php

use yii\db\Migration;

/**
 * Handles the creation of table `request_add_to_team`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `team`
 */
class m181029_061908_create_request_add_to_team_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('request_add_to_team', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'team_id' => $this->integer(),
            'result' => $this->smallInteger(2),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-request_add_to_team-user_id',
            'request_add_to_team',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-request_add_to_team-user_id',
            'request_add_to_team',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `team_id`
        $this->createIndex(
            'idx-request_add_to_team-team_id',
            'request_add_to_team',
            'team_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-request_add_to_team-team_id',
            'request_add_to_team',
            'team_id',
            'team',
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
            'fk-request_add_to_team-user_id',
            'request_add_to_team'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-request_add_to_team-user_id',
            'request_add_to_team'
        );

        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-request_add_to_team-team_id',
            'request_add_to_team'
        );

        // drops index for column `team_id`
        $this->dropIndex(
            'idx-request_add_to_team-team_id',
            'request_add_to_team'
        );

        $this->dropTable('request_add_to_team');
    }
}
