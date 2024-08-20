<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820153102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar ALTER is_unlock SET DEFAULT false');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT fk_4586aafba76ed395');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT fk_4586aafbe48fd905');
        $this->addSql('DROP INDEX idx_4586aafbe48fd905');
        $this->addSql('DROP INDEX idx_4586aafba76ed395');
        $this->addSql('ALTER TABLE game_session DROP user_id');
        $this->addSql('ALTER TABLE game_session DROP game_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE avatar ALTER is_unlock DROP DEFAULT');
        $this->addSql('ALTER TABLE game_session ADD user_id UUID NOT NULL');
        $this->addSql('ALTER TABLE game_session ADD game_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN game_session.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT fk_4586aafba76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT fk_4586aafbe48fd905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_4586aafbe48fd905 ON game_session (game_id)');
        $this->addSql('CREATE INDEX idx_4586aafba76ed395 ON game_session (user_id)');
    }
}
