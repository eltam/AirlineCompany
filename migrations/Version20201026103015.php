<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026103015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE departure_air_crew');
        $this->addSql('ALTER TABLE departure ADD purser_id INT DEFAULT NULL, ADD crew_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE departure ADD CONSTRAINT FK_45E9C671DBF7AEA FOREIGN KEY (purser_id) REFERENCES air_crew (id)');
        $this->addSql('ALTER TABLE departure ADD CONSTRAINT FK_45E9C6715FE259F6 FOREIGN KEY (crew_id) REFERENCES air_crew (id)');
        $this->addSql('CREATE INDEX IDX_45E9C671DBF7AEA ON departure (purser_id)');
        $this->addSql('CREATE INDEX IDX_45E9C6715FE259F6 ON departure (crew_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departure_air_crew (departure_id INT NOT NULL, air_crew_id INT NOT NULL, INDEX IDX_8F95B9597704ED06 (departure_id), INDEX IDX_8F95B95947F25B1F (air_crew_id), PRIMARY KEY(departure_id, air_crew_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE departure_air_crew ADD CONSTRAINT FK_8F95B95947F25B1F FOREIGN KEY (air_crew_id) REFERENCES air_crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departure_air_crew ADD CONSTRAINT FK_8F95B9597704ED06 FOREIGN KEY (departure_id) REFERENCES departure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departure DROP FOREIGN KEY FK_45E9C671DBF7AEA');
        $this->addSql('ALTER TABLE departure DROP FOREIGN KEY FK_45E9C6715FE259F6');
        $this->addSql('DROP INDEX IDX_45E9C671DBF7AEA ON departure');
        $this->addSql('DROP INDEX IDX_45E9C6715FE259F6 ON departure');
        $this->addSql('ALTER TABLE departure DROP purser_id, DROP crew_id');
    }
}
