<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220226133508 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__cursos AS SELECT id, descricao, nota FROM cursos');
        $this->addSql('DROP TABLE cursos');
        $this->addSql('CREATE TABLE cursos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL COLLATE BINARY, nota INTEGER DEFAULT 5 NOT NULL)');
        $this->addSql('INSERT INTO cursos (id, descricao, nota) SELECT id, descricao, nota FROM __temp__cursos');
        $this->addSql('DROP TABLE __temp__cursos');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE cursos ADD COLUMN colunaNova VARCHAR(255) DEFAULT NULL COLLATE BINARY');
    }
}
