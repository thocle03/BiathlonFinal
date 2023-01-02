<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102094645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9A513A63E');
        $this->addSql('DROP TABLE classement');
        $this->addSql('DROP INDEX UNIQ_169E6FB9A513A63E ON course');
        $this->addSql('ALTER TABLE course ADD classement VARCHAR(255) NOT NULL, DROP classement_id, CHANGE image image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classement (id INT AUTO_INCREMENT NOT NULL, position VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, create_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE course ADD classement_id INT DEFAULT NULL, DROP classement, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9A513A63E FOREIGN KEY (classement_id) REFERENCES classement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_169E6FB9A513A63E ON course (classement_id)');
    }
}
