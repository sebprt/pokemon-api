<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820123856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE multiple_choice_answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE multiple_choice_question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE text_input_answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE text_input_question_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, user_id UUID NOT NULL, session_id INT NOT NULL, question_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_correct BOOLEAN NOT NULL, answer_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A25A76ED395 ON answer (user_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25613FECDF ON answer (session_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('COMMENT ON COLUMN answer.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN answer.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, game_id UUID NOT NULL, label VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494EE48FD905 ON question (game_id)');
        $this->addSql('COMMENT ON COLUMN question.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN question.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN question.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25613FECDF FOREIGN KEY (session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT fk_5af0920a76ed395');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT fk_5af0920613fecdf');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT fk_5af09201e27f6bf');
        $this->addSql('DROP INDEX idx_5af09201e27f6bf');
        $this->addSql('DROP INDEX idx_5af0920613fecdf');
        $this->addSql('DROP INDEX idx_5af0920a76ed395');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP user_id');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP session_id');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP question_id');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP date');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP is_correct');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT FK_5AF0920BF396750 FOREIGN KEY (id) REFERENCES answer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_question DROP CONSTRAINT fk_24557253e48fd905');
        $this->addSql('DROP INDEX idx_24557253e48fd905');
        $this->addSql('ALTER TABLE multiple_choice_question DROP game_id');
        $this->addSql('ALTER TABLE multiple_choice_question DROP label');
        $this->addSql('ALTER TABLE multiple_choice_question DROP media');
        $this->addSql('ALTER TABLE multiple_choice_question DROP created_at');
        $this->addSql('ALTER TABLE multiple_choice_question DROP updated_at');
        $this->addSql('ALTER TABLE multiple_choice_question ADD CONSTRAINT FK_24557253BF396750 FOREIGN KEY (id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_answer DROP CONSTRAINT fk_e41b85b6a76ed395');
        $this->addSql('ALTER TABLE text_input_answer DROP CONSTRAINT fk_e41b85b6613fecdf');
        $this->addSql('ALTER TABLE text_input_answer DROP CONSTRAINT fk_e41b85b61e27f6bf');
        $this->addSql('DROP INDEX idx_e41b85b61e27f6bf');
        $this->addSql('DROP INDEX idx_e41b85b6613fecdf');
        $this->addSql('DROP INDEX idx_e41b85b6a76ed395');
        $this->addSql('ALTER TABLE text_input_answer DROP user_id');
        $this->addSql('ALTER TABLE text_input_answer DROP session_id');
        $this->addSql('ALTER TABLE text_input_answer DROP question_id');
        $this->addSql('ALTER TABLE text_input_answer DROP date');
        $this->addSql('ALTER TABLE text_input_answer DROP is_correct');
        $this->addSql('ALTER TABLE text_input_answer ADD CONSTRAINT FK_E41B85B6BF396750 FOREIGN KEY (id) REFERENCES answer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_question DROP CONSTRAINT fk_e7407170e48fd905');
        $this->addSql('DROP INDEX idx_e7407170e48fd905');
        $this->addSql('ALTER TABLE text_input_question DROP game_id');
        $this->addSql('ALTER TABLE text_input_question DROP label');
        $this->addSql('ALTER TABLE text_input_question DROP media');
        $this->addSql('ALTER TABLE text_input_question DROP created_at');
        $this->addSql('ALTER TABLE text_input_question DROP updated_at');
        $this->addSql('ALTER TABLE text_input_question ADD CONSTRAINT FK_E7407170BF396750 FOREIGN KEY (id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE multiple_choice_answer DROP CONSTRAINT FK_5AF0920BF396750');
        $this->addSql('ALTER TABLE text_input_answer DROP CONSTRAINT FK_E41B85B6BF396750');
        $this->addSql('ALTER TABLE multiple_choice_question DROP CONSTRAINT FK_24557253BF396750');
        $this->addSql('ALTER TABLE text_input_question DROP CONSTRAINT FK_E7407170BF396750');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE multiple_choice_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE multiple_choice_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE text_input_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE text_input_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A25A76ED395');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A25613FECDF');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494EE48FD905');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE question');
        $this->addSql('ALTER TABLE text_input_answer ADD user_id UUID NOT NULL');
        $this->addSql('ALTER TABLE text_input_answer ADD session_id INT NOT NULL');
        $this->addSql('ALTER TABLE text_input_answer ADD question_id INT NOT NULL');
        $this->addSql('ALTER TABLE text_input_answer ADD date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE text_input_answer ADD is_correct BOOLEAN NOT NULL');
        $this->addSql('COMMENT ON COLUMN text_input_answer.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN text_input_answer.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE text_input_answer ADD CONSTRAINT fk_e41b85b6a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_answer ADD CONSTRAINT fk_e41b85b6613fecdf FOREIGN KEY (session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_input_answer ADD CONSTRAINT fk_e41b85b61e27f6bf FOREIGN KEY (question_id) REFERENCES text_input_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e41b85b61e27f6bf ON text_input_answer (question_id)');
        $this->addSql('CREATE INDEX idx_e41b85b6613fecdf ON text_input_answer (session_id)');
        $this->addSql('CREATE INDEX idx_e41b85b6a76ed395 ON text_input_answer (user_id)');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD user_id UUID NOT NULL');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD session_id INT NOT NULL');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD question_id INT NOT NULL');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD is_correct BOOLEAN NOT NULL');
        $this->addSql('COMMENT ON COLUMN multiple_choice_answer.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN multiple_choice_answer.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT fk_5af0920a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT fk_5af0920613fecdf FOREIGN KEY (session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_choice_answer ADD CONSTRAINT fk_5af09201e27f6bf FOREIGN KEY (question_id) REFERENCES multiple_choice_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5af09201e27f6bf ON multiple_choice_answer (question_id)');
        $this->addSql('CREATE INDEX idx_5af0920613fecdf ON multiple_choice_answer (session_id)');
        $this->addSql('CREATE INDEX idx_5af0920a76ed395 ON multiple_choice_answer (user_id)');
        $this->addSql('ALTER TABLE multiple_choice_question ADD game_id UUID NOT NULL');
        $this->addSql('ALTER TABLE multiple_choice_question ADD label VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE multiple_choice_question ADD media VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE multiple_choice_question ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE multiple_choice_question ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN multiple_choice_question.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE multiple_choice_question ADD CONSTRAINT fk_24557253e48fd905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_24557253e48fd905 ON multiple_choice_question (game_id)');
        $this->addSql('ALTER TABLE text_input_question ADD game_id UUID NOT NULL');
        $this->addSql('ALTER TABLE text_input_question ADD label VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE text_input_question ADD media VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE text_input_question ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE text_input_question ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN text_input_question.game_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN text_input_question.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN text_input_question.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE text_input_question ADD CONSTRAINT fk_e7407170e48fd905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e7407170e48fd905 ON text_input_question (game_id)');
    }
}
