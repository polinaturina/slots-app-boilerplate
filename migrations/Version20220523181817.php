<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523181817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create slot table with foreign key';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE slot (id INTEGER PRIMARY KEY NOT NULL, date_from DATETIME NOT NULL, date_to DATETIME NOT NULL, doctor_id INTEGER NOT NULL, FOREIGN KEY (doctor_id) REFERENCES doctor(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE slot');
    }
}
