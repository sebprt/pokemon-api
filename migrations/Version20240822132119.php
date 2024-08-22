<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240822132119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id UUID NOT NULL, user_id UUID NOT NULL, question_id UUID NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_correct BOOLEAN NOT NULL, answer_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A25A76ED395 ON answer (user_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('COMMENT ON COLUMN answer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN answer.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN answer.question_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN answer.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE avatar (id UUID NOT NULL, name VARCHAR(255) NOT NULL, unlock_points INT NOT NULL, is_unlock BOOLEAN DEFAULT false NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN avatar.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE choice (id UUID NOT NULL, label VARCHAR(255) NOT NULL, is_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN choice.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN game.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game_question (game_id UUID NOT NULL, question_id UUID NOT NULL, PRIMARY KEY(game_id, question_id))');
        $this->addSql('CREATE INDEX IDX_1DB3B668E48FD905 ON game_question (game_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1DB3B6681E27F6BF ON game_question (question_id)');
        $this->addSql('COMMENT ON COLUMN game_question.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_question.question_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game_session (id UUID NOT NULL, user_id UUID NOT NULL, game_id UUID NOT NULL, score INT DEFAULT 0 NOT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ended_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_completed BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4586AAFBA76ED395 ON game_session (user_id)');
        $this->addSql('CREATE INDEX IDX_4586AAFBE48FD905 ON game_session (game_id)');
        $this->addSql('COMMENT ON COLUMN game_session.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.started_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN game_session.ended_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE game_session_answer (game_session_id UUID NOT NULL, answer_id UUID NOT NULL, PRIMARY KEY(game_session_id, answer_id))');
        $this->addSql('CREATE INDEX IDX_6F7C1C308FE32B32 ON game_session_answer (game_session_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6F7C1C30AA334807 ON game_session_answer (answer_id)');
        $this->addSql('COMMENT ON COLUMN game_session_answer.game_session_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session_answer.answer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE level (id UUID NOT NULL, number INT NOT NULL, required_points BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN level.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE multiple_choice_answer (id UUID NOT NULL, choice_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5AF0920998666D1 ON multiple_choice_answer (choice_id)');
        $this->addSql('COMMENT ON COLUMN multiple_choice_answer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN multiple_choice_answer.choice_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE multiple_choice_question (id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE multiple_choice_question_choice (multiple_choice_question_id UUID NOT NULL, choice_id UUID NOT NULL, PRIMARY KEY(multiple_choice_question_id, choice_id))');
        $this->addSql('CREATE INDEX IDX_B3EC9A23EB3EBF2 ON multiple_choice_question_choice (multiple_choice_question_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3EC9A23998666D1 ON multiple_choice_question_choice (choice_id)');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question_choice.multiple_choice_question_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question_choice.choice_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE question (id UUID NOT NULL, label VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN question.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN question.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN question.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE reward (id UUID NOT NULL, name VARCHAR(255) NOT NULL, condition JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN reward.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reward.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reward.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE text_input_answer (id UUID NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN text_input_answer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE text_input_question (id UUID NOT NULL, correct_answer VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN text_input_question.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, level_id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, experience INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D6495FB14BA7 ON "user" (level_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".level_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_user_reward (user_id UUID NOT NULL, user_reward_id UUID NOT NULL, PRIMARY KEY(user_id, user_reward_id))');
        $this->addSql('CREATE INDEX IDX_8298A0FBA76ED395 ON user_user_reward (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8298A0FBE4862145 ON user_user_reward (user_reward_id)');
        $this->addSql('COMMENT ON COLUMN user_user_reward.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_user_reward.user_reward_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE user_user_avatar (user_id UUID NOT NULL, user_avatar_id UUID NOT NULL, PRIMARY KEY(user_id, user_avatar_id))');
        $this->addSql('CREATE INDEX IDX_DA3EA087A76ED395 ON user_user_avatar (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DA3EA08786D8B6F4 ON user_user_avatar (user_avatar_id)');
        $this->addSql('COMMENT ON COLUMN user_user_avatar.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_user_avatar.user_avatar_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE user_avatar (id UUID NOT NULL, avatar_id UUID NOT NULL, is_current BOOLEAN NOT NULL, unlocked_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7325691286383B10 ON user_avatar (avatar_id)');
        $this->addSql('COMMENT ON COLUMN user_avatar.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_avatar.avatar_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_avatar.unlocked_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_reward (id UUID NOT NULL, reward_id UUID NOT NULL, unlocked_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2B83696EE466ACA1 ON user_reward (reward_id)');
        $this->addSql('COMMENT ON COLUMN user_reward.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_reward.reward_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_reward.unlocked_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT FK_1DB3B668E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT FK_1DB3B6681E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_answer ADD CONSTRAINT FK_6F7C1C308FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_answer ADD CONSTRAINT FK_6F7C1C30AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT FK_5AF0920998666D1 FOREIGN KEY (choice_id) REFERENCES choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT FK_5AF0920BF396750 FOREIGN KEY (id) REFERENCES answer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_question ADD CONSTRAINT FK_24557253BF396750 FOREIGN KEY (id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_question_choice ADD CONSTRAINT FK_B3EC9A23EB3EBF2 FOREIGN KEY (multiple_choice_question_id) REFERENCES multiple_choice_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_question_choice ADD CONSTRAINT FK_B3EC9A23998666D1 FOREIGN KEY (choice_id) REFERENCES choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_answer ADD CONSTRAINT FK_E41B85B6BF396750 FOREIGN KEY (id) REFERENCES answer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_question ADD CONSTRAINT FK_E7407170BF396750 FOREIGN KEY (id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6495FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_reward ADD CONSTRAINT FK_8298A0FBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_reward ADD CONSTRAINT FK_8298A0FBE4862145 FOREIGN KEY (user_reward_id) REFERENCES user_reward (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_avatar ADD CONSTRAINT FK_DA3EA087A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_avatar ADD CONSTRAINT FK_DA3EA08786D8B6F4 FOREIGN KEY (user_avatar_id) REFERENCES user_avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_avatar ADD CONSTRAINT FK_7325691286383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_reward ADD CONSTRAINT FK_2B83696EE466ACA1 FOREIGN KEY (reward_id) REFERENCES reward (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A25A76ED395');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT FK_1DB3B668E48FD905');
        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT FK_1DB3B6681E27F6BF');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBA76ED395');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBE48FD905');
        $this->addSql('ALTER TABLE game_session_answer DROP CONSTRAINT FK_6F7C1C308FE32B32');
        $this->addSql('ALTER TABLE game_session_answer DROP CONSTRAINT FK_6F7C1C30AA334807');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT FK_5AF0920998666D1');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT FK_5AF0920BF396750');
        $this->addSql('ALTER TABLE multiple_choice_question DROP CONSTRAINT FK_24557253BF396750');
        $this->addSql('ALTER TABLE multiple_choice_question_choice DROP CONSTRAINT FK_B3EC9A23EB3EBF2');
        $this->addSql('ALTER TABLE multiple_choice_question_choice DROP CONSTRAINT FK_B3EC9A23998666D1');
        $this->addSql('ALTER TABLE text_input_answer DROP CONSTRAINT FK_E41B85B6BF396750');
        $this->addSql('ALTER TABLE text_input_question DROP CONSTRAINT FK_E7407170BF396750');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6495FB14BA7');
        $this->addSql('ALTER TABLE user_user_reward DROP CONSTRAINT FK_8298A0FBA76ED395');
        $this->addSql('ALTER TABLE user_user_reward DROP CONSTRAINT FK_8298A0FBE4862145');
        $this->addSql('ALTER TABLE user_user_avatar DROP CONSTRAINT FK_DA3EA087A76ED395');
        $this->addSql('ALTER TABLE user_user_avatar DROP CONSTRAINT FK_DA3EA08786D8B6F4');
        $this->addSql('ALTER TABLE user_avatar DROP CONSTRAINT FK_7325691286383B10');
        $this->addSql('ALTER TABLE user_reward DROP CONSTRAINT FK_2B83696EE466ACA1');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_question');
        $this->addSql('DROP TABLE game_session');
        $this->addSql('DROP TABLE game_session_answer');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE multiple_choice_answer');
        $this->addSql('DROP TABLE multiple_choice_question');
        $this->addSql('DROP TABLE multiple_choice_question_choice');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE reward');
        $this->addSql('DROP TABLE text_input_answer');
        $this->addSql('DROP TABLE text_input_question');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_user_reward');
        $this->addSql('DROP TABLE user_user_avatar');
        $this->addSql('DROP TABLE user_avatar');
        $this->addSql('DROP TABLE user_reward');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
