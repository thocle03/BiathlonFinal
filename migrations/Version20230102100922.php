<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102100922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course ADD classement2 VARCHAR(255) NOT NULL, ADD classement3 VARCHAR(255) NOT NULL, ADD classement4 VARCHAR(255) NOT NULL, ADD classement5 VARCHAR(255) NOT NULL, ADD classement6 VARCHAR(255) NOT NULL, ADD classement7 VARCHAR(255) NOT NULL, ADD classement8 VARCHAR(255) NOT NULL, ADD classement9 VARCHAR(255) NOT NULL, ADD classement10 VARCHAR(255) NOT NULL, CHANGE classement classement1 VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course ADD classement VARCHAR(255) NOT NULL, DROP classement1, DROP classement2, DROP classement3, DROP classement4, DROP classement5, DROP classement6, DROP classement7, DROP classement8, DROP classement9, DROP classement10');
    }
}
