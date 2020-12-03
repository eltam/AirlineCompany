<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203111317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departure CHANGE copilot_id copilot_id INT NOT NULL');
        $this->addSql('ALTER TABLE departure ADD CONSTRAINT FK_45E9C671DBF7AEA FOREIGN KEY (purser_id) REFERENCES air_crew (id)');
        $this->addSql('CREATE INDEX IDX_45E9C671DBF7AEA ON departure (purser_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departure DROP FOREIGN KEY FK_45E9C671DBF7AEA');
        $this->addSql('DROP INDEX IDX_45E9C671DBF7AEA ON departure');
        $this->addSql('ALTER TABLE departure CHANGE copilot_id copilot_id INT DEFAULT NULL');
    }
}
