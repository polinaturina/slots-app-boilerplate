<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523181716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Drop slot table to re-create one with foreign key';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('DROP TABLE slot');
    }

    public function down(Schema $schema) : void
    {
    }
}
