<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821135858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_level_progression_id_seq CASCADE');
        $this->addSql('ALTER TABLE user_level_progression DROP CONSTRAINT fk_dc5e8d05a76ed395');
        $this->addSql('ALTER TABLE user_level_progression DROP CONSTRAINT fk_dc5e8d055fb14ba7');
        $this->addSql('DROP TABLE user_level_progression');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE user_level_progression_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_level_progression (id INT NOT NULL, user_id UUID NOT NULL, level_id INT NOT NULL, achieved_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_dc5e8d055fb14ba7 ON user_level_progression (level_id)');
        $this->addSql('CREATE INDEX idx_dc5e8d05a76ed395 ON user_level_progression (user_id)');
        $this->addSql('COMMENT ON COLUMN user_level_progression.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_level_progression.achieved_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user_level_progression ADD CONSTRAINT fk_dc5e8d05a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_level_progression ADD CONSTRAINT fk_dc5e8d055fb14ba7 FOREIGN KEY (level_id) REFERENCES level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
