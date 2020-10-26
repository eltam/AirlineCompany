<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026095231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departure_air_crew (departure_id INT NOT NULL, air_crew_id INT NOT NULL, INDEX IDX_8F95B9597704ED06 (departure_id), INDEX IDX_8F95B95947F25B1F (air_crew_id), PRIMARY KEY(departure_id, air_crew_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departure_air_crew ADD CONSTRAINT FK_8F95B9597704ED06 FOREIGN KEY (departure_id) REFERENCES departure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departure_air_crew ADD CONSTRAINT FK_8F95B95947F25B1F FOREIGN KEY (air_crew_id) REFERENCES air_crew (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE departure_aircrew');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departure_aircrew (departure_id INT NOT NULL, aircrew_id INT NOT NULL, INDEX IDX_AE6EAD0D19420A2 (aircrew_id), INDEX IDX_AE6EAD0D7704ED06 (departure_id), PRIMARY KEY(departure_id, aircrew_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE departure_aircrew ADD CONSTRAINT FK_AE6EAD0D19420A2 FOREIGN KEY (aircrew_id) REFERENCES air_crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departure_aircrew ADD CONSTRAINT FK_AE6EAD0D7704ED06 FOREIGN KEY (departure_id) REFERENCES departure (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE departure_air_crew');
    }
}
