<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210163958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD course_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('CREATE INDEX IDX_9474526C591CC992 ON comment (course_id)');
        $this->addSql('ALTER TABLE course ADD classement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9A513A63E FOREIGN KEY (classement_id) REFERENCES classement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_169E6FB9A513A63E ON course (classement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C591CC992');
        $this->addSql('DROP INDEX IDX_9474526C591CC992 ON comment');
        $this->addSql('ALTER TABLE comment DROP course_id');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9A513A63E');
        $this->addSql('DROP INDEX UNIQ_169E6FB9A513A63E ON course');
        $this->addSql('ALTER TABLE course DROP classement_id');
    }
}
