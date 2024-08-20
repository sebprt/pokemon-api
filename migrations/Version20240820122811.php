<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820122811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE avatar_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE choice_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_session_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE level_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE multiple_choice_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE multiple_choice_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reward_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE text_input_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE text_input_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_level_progression_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE avatar (id INT NOT NULL, name VARCHAR(255) NOT NULL, unlock_points INT NOT NULL, is_unlock BOOLEAN NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE choice (id INT NOT NULL, question_id INT NOT NULL, label VARCHAR(255) NOT NULL, is_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1AB5A921E27F6BF ON choice (question_id)');
        $this->addSql('CREATE TABLE game (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN game.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game_session (id INT NOT NULL, user_id UUID NOT NULL, game_id UUID NOT NULL, score INT DEFAULT 0 NOT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ended_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_completed BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4586AAFBA76ED395 ON game_session (user_id)');
        $this->addSql('CREATE INDEX IDX_4586AAFBE48FD905 ON game_session (game_id)');
        $this->addSql('COMMENT ON COLUMN game_session.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.started_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN game_session.ended_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE level (id INT NOT NULL, number INT NOT NULL, required_points BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE multiple_choice_answer (id INT NOT NULL, user_id UUID NOT NULL, session_id INT NOT NULL, choice_id INT NOT NULL, question_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5AF0920A76ED395 ON multiple_choice_answer (user_id)');
        $this->addSql('CREATE INDEX IDX_5AF0920613FECDF ON multiple_choice_answer (session_id)');
        $this->addSql('CREATE INDEX IDX_5AF0920998666D1 ON multiple_choice_answer (choice_id)');
        $this->addSql('CREATE INDEX IDX_5AF09201E27F6BF ON multiple_choice_answer (question_id)');
        $this->addSql('COMMENT ON COLUMN multiple_choice_answer.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN multiple_choice_answer.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE multiple_choice_question (id INT NOT NULL, game_id UUID NOT NULL, label VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_24557253E48FD905 ON multiple_choice_question (game_id)');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE reward (id INT NOT NULL, game_id UUID NOT NULL, name VARCHAR(255) NOT NULL, condition JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4ED17253E48FD905 ON reward (game_id)');
        $this->addSql('COMMENT ON COLUMN reward.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reward.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reward.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE text_input_answer (id INT NOT NULL, user_id UUID NOT NULL, session_id INT NOT NULL, question_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_correct BOOLEAN NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E41B85B6A76ED395 ON text_input_answer (user_id)');
        $this->addSql('CREATE INDEX IDX_E41B85B6613FECDF ON text_input_answer (session_id)');
        $this->addSql('CREATE INDEX IDX_E41B85B61E27F6BF ON text_input_answer (question_id)');
        $this->addSql('COMMENT ON COLUMN text_input_answer.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN text_input_answer.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE text_input_question (id INT NOT NULL, game_id UUID NOT NULL, label VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, correct_answer VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E7407170E48FD905 ON text_input_question (game_id)');
        $this->addSql('COMMENT ON COLUMN text_input_question.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN text_input_question.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN text_input_question.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, level_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, experience INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D6495FB14BA7 ON "user" (level_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_avatar (user_id UUID NOT NULL, avatar_id INT NOT NULL, is_current BOOLEAN NOT NULL, unlocked_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(user_id, avatar_id))');
        $this->addSql('CREATE INDEX IDX_73256912A76ED395 ON user_avatar (user_id)');
        $this->addSql('CREATE INDEX IDX_7325691286383B10 ON user_avatar (avatar_id)');
        $this->addSql('COMMENT ON COLUMN user_avatar.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_avatar.unlocked_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_level_progression (id INT NOT NULL, user_id UUID NOT NULL, level_id INT NOT NULL, achieved_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DC5E8D05A76ED395 ON user_level_progression (user_id)');
        $this->addSql('CREATE INDEX IDX_DC5E8D055FB14BA7 ON user_level_progression (level_id)');
        $this->addSql('COMMENT ON COLUMN user_level_progression.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_level_progression.achieved_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_reward (user_id UUID NOT NULL, reward_id INT NOT NULL, unlocked_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(user_id, reward_id))');
        $this->addSql('CREATE INDEX IDX_2B83696EA76ED395 ON user_reward (user_id)');
        $this->addSql('CREATE INDEX IDX_2B83696EE466ACA1 ON user_reward (reward_id)');
        $this->addSql('COMMENT ON COLUMN user_reward.user_id IS \'(DC2Type:uuid)\'');
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
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A921E27F6BF FOREIGN KEY (question_id) REFERENCES multiple_choice_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT FK_5AF0920A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT FK_5AF0920613FECDF FOREIGN KEY (session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT FK_5AF0920998666D1 FOREIGN KEY (choice_id) REFERENCES choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT FK_5AF09201E27F6BF FOREIGN KEY (question_id) REFERENCES multiple_choice_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_question ADD CONSTRAINT FK_24557253E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reward ADD CONSTRAINT FK_4ED17253E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_answer ADD CONSTRAINT FK_E41B85B6A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_answer ADD CONSTRAINT FK_E41B85B6613FECDF FOREIGN KEY (session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_answer ADD CONSTRAINT FK_E41B85B61E27F6BF FOREIGN KEY (question_id) REFERENCES text_input_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_question ADD CONSTRAINT FK_E7407170E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6495FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_avatar ADD CONSTRAINT FK_73256912A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_avatar ADD CONSTRAINT FK_7325691286383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_level_progression ADD CONSTRAINT FK_DC5E8D05A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_level_progression ADD CONSTRAINT FK_DC5E8D055FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_reward ADD CONSTRAINT FK_2B83696EA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_reward ADD CONSTRAINT FK_2B83696EE466ACA1 FOREIGN KEY (reward_id) REFERENCES reward (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE avatar_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE choice_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_session_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE level_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE multiple_choice_answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE multiple_choice_question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reward_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE text_input_answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE text_input_question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_level_progression_id_seq CASCADE');
        $this->addSql('ALTER TABLE choice DROP CONSTRAINT FK_C1AB5A921E27F6BF');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBA76ED395');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBE48FD905');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT FK_5AF0920A76ED395');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT FK_5AF0920613FECDF');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT FK_5AF0920998666D1');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT FK_5AF09201E27F6BF');
        $this->addSql('ALTER TABLE multiple_choice_question DROP CONSTRAINT FK_24557253E48FD905');
        $this->addSql('ALTER TABLE reward DROP CONSTRAINT FK_4ED17253E48FD905');
        $this->addSql('ALTER TABLE text_input_answer DROP CONSTRAINT FK_E41B85B6A76ED395');
        $this->addSql('ALTER TABLE text_input_answer DROP CONSTRAINT FK_E41B85B6613FECDF');
        $this->addSql('ALTER TABLE text_input_answer DROP CONSTRAINT FK_E41B85B61E27F6BF');
        $this->addSql('ALTER TABLE text_input_question DROP CONSTRAINT FK_E7407170E48FD905');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6495FB14BA7');
        $this->addSql('ALTER TABLE user_avatar DROP CONSTRAINT FK_73256912A76ED395');
        $this->addSql('ALTER TABLE user_avatar DROP CONSTRAINT FK_7325691286383B10');
        $this->addSql('ALTER TABLE user_level_progression DROP CONSTRAINT FK_DC5E8D05A76ED395');
        $this->addSql('ALTER TABLE user_level_progression DROP CONSTRAINT FK_DC5E8D055FB14BA7');
        $this->addSql('ALTER TABLE user_reward DROP CONSTRAINT FK_2B83696EA76ED395');
        $this->addSql('ALTER TABLE user_reward DROP CONSTRAINT FK_2B83696EE466ACA1');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_session');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE multiple_choice_answer');
        $this->addSql('DROP TABLE multiple_choice_question');
        $this->addSql('DROP TABLE reward');
        $this->addSql('DROP TABLE text_input_answer');
        $this->addSql('DROP TABLE text_input_question');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_avatar');
        $this->addSql('DROP TABLE user_level_progression');
        $this->addSql('DROP TABLE user_reward');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
