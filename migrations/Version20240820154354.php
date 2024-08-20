<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820154354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_session ADD user_id UUID NOT NULL');
        $this->addSql('ALTER TABLE game_session ADD game_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN game_session.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN game_session.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFBE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4586AAFBA76ED395 ON game_session (user_id)');
        $this->addSql('CREATE INDEX IDX_4586AAFBE48FD905 ON game_session (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBA76ED395');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFBE48FD905');
        $this->addSql('DROP INDEX IDX_4586AAFBA76ED395');
        $this->addSql('DROP INDEX IDX_4586AAFBE48FD905');
        $this->addSql('ALTER TABLE game_session DROP user_id');
        $this->addSql('ALTER TABLE game_session DROP game_id');
    }
}
