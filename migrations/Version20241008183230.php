<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241008183230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avatar (id UUID NOT NULL, name VARCHAR(255) NOT NULL, unlock_points INT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN avatar.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN game.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE game_session (id UUID NOT NULL, user_id UUID NOT NULL, game_id UUID NOT NULL, score INT DEFAULT 0 NOT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ended_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_completed BOOLEAN NOT NULL, questions_answered INT NOT NULL, correct_answers INT NOT NULL, accuracy DOUBLE PRECISION NOT NULL, current_streak INT NOT NULL, max_streak INT NOT NULL, earned_experience INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4586AAFBA76ED395 ON game_session (user_id)');
        $this->addSql('CREATE INDEX IDX_4586AAFBE48FD905 ON game_session (game_id)');
        $this->addSql('COMMENT ON COLUMN game_session.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.started_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN game_session.ended_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE level (id UUID NOT NULL, number INT NOT NULL, experience_required INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN level.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE reward (id UUID NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, unlock_points INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN reward.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reward.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reward.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, profile_id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649CCFA12B8 ON "user" (profile_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".profile_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".updated_at IS \'(DC2Type:datetime_immutable)\'');
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
        $this->addSql('CREATE TABLE user_avatar (id UUID NOT NULL, avatar_id UUID NOT NULL, unlocked_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7325691286383B10 ON user_avatar (avatar_id)');
        $this->addSql('COMMENT ON COLUMN user_avatar.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_avatar.avatar_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_avatar.unlocked_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_profile (id UUID NOT NULL, current_avatar_id UUID DEFAULT NULL, total_points INT NOT NULL, experience_points INT NOT NULL, level INT NOT NULL, games_played INT NOT NULL, accuracy_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D95AB4055D1E8ABC ON user_profile (current_avatar_id)');
        $this->addSql('COMMENT ON COLUMN user_profile.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_profile.current_avatar_id IS \'(DC2Type:uuid)\'');
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
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_reward ADD CONSTRAINT FK_8298A0FBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_reward ADD CONSTRAINT FK_8298A0FBE4862145 FOREIGN KEY (user_reward_id) REFERENCES user_reward (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_avatar ADD CONSTRAINT FK_DA3EA087A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user_avatar ADD CONSTRAINT FK_DA3EA08786D8B6F4 FOREIGN KEY (user_avatar_id) REFERENCES user_avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_avatar ADD CONSTRAINT FK_7325691286383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB4055D1E8ABC FOREIGN KEY (current_avatar_id) REFERENCES avatar (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_reward ADD CONSTRAINT FK_2B83696EE466ACA1 FOREIGN KEY (reward_id) REFERENCES reward (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBA76ED395');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBE48FD905');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649CCFA12B8');
        $this->addSql('ALTER TABLE user_user_reward DROP CONSTRAINT FK_8298A0FBA76ED395');
        $this->addSql('ALTER TABLE user_user_reward DROP CONSTRAINT FK_8298A0FBE4862145');
        $this->addSql('ALTER TABLE user_user_avatar DROP CONSTRAINT FK_DA3EA087A76ED395');
        $this->addSql('ALTER TABLE user_user_avatar DROP CONSTRAINT FK_DA3EA08786D8B6F4');
        $this->addSql('ALTER TABLE user_avatar DROP CONSTRAINT FK_7325691286383B10');
        $this->addSql('ALTER TABLE user_profile DROP CONSTRAINT FK_D95AB4055D1E8ABC');
        $this->addSql('ALTER TABLE user_reward DROP CONSTRAINT FK_2B83696EE466ACA1');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_session');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE reward');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_user_reward');
        $this->addSql('DROP TABLE user_user_avatar');
        $this->addSql('DROP TABLE user_avatar');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('DROP TABLE user_reward');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
