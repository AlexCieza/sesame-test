<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825101110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Sellers';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE sellers (
                id VARCHAR(36) NOT NULL,
                name VARCHAR(255) NOT NULL,
                description VARCHAR(255) NOT NULL,
                version int not null default 1,
                PRIMARY KEY(id)
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE sellers');
    }
}
