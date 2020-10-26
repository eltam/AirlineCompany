<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025211848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flight ADD depart_airport_id INT DEFAULT NULL, ADD arrival_airport_id INT DEFAULT NULL, ADD aircraft_id INT DEFAULT NULL, DROP depart_airport, DROP arrival_airport, DROP aircraft');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E40230406 FOREIGN KEY (depart_airport_id) REFERENCES airport (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E7F43E343 FOREIGN KEY (arrival_airport_id) REFERENCES airport (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E846E2F5C FOREIGN KEY (aircraft_id) REFERENCES aircraft (id)');
        $this->addSql('CREATE INDEX IDX_C257E60E40230406 ON flight (depart_airport_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E7F43E343 ON flight (arrival_airport_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C257E60E846E2F5C ON flight (aircraft_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E40230406');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E7F43E343');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E846E2F5C');
        $this->addSql('DROP INDEX IDX_C257E60E40230406 ON flight');
        $this->addSql('DROP INDEX IDX_C257E60E7F43E343 ON flight');
        $this->addSql('DROP INDEX UNIQ_C257E60E846E2F5C ON flight');
        $this->addSql('ALTER TABLE flight ADD depart_airport VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD arrival_airport VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD aircraft VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP depart_airport_id, DROP arrival_airport_id, DROP aircraft_id');
    }
}
