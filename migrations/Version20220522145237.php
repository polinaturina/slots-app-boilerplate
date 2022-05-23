<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220522145237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create /"doctor"/ table"';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE doctor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT unique_name UNIQUE (name))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE doctor');
    }
}
