<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026092714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, address LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departure (id INT AUTO_INCREMENT NOT NULL, flight_id INT NOT NULL, pilot_id INT NOT NULL, copilot_id INT DEFAULT NULL, departure_date DATE NOT NULL, passengers INT NOT NULL, INDEX IDX_45E9C67191F478C5 (flight_id), INDEX IDX_45E9C671CE55439B (pilot_id), INDEX IDX_45E9C671F1F70582 (copilot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departure_aircrew (departure_id INT NOT NULL, aircrew_id INT NOT NULL, INDEX IDX_AE6EAD0D7704ED06 (departure_id), INDEX IDX_AE6EAD0D19420A2 (aircrew_id), PRIMARY KEY(departure_id, aircrew_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, departure_id INT NOT NULL, client_id INT NOT NULL, issue_date DATETIME NOT NULL, INDEX IDX_97A0ADA37704ED06 (departure_id), INDEX IDX_97A0ADA319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departure ADD CONSTRAINT FK_45E9C67191F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE departure ADD CONSTRAINT FK_45E9C671CE55439B FOREIGN KEY (pilot_id) REFERENCES pilot (id)');
        $this->addSql('ALTER TABLE departure ADD CONSTRAINT FK_45E9C671F1F70582 FOREIGN KEY (copilot_id) REFERENCES pilot (id)');
        $this->addSql('ALTER TABLE departure_aircrew ADD CONSTRAINT FK_AE6EAD0D7704ED06 FOREIGN KEY (departure_id) REFERENCES departure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departure_aircrew ADD CONSTRAINT FK_AE6EAD0D19420A2 FOREIGN KEY (aircrew_id) REFERENCES air_crew (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA37704ED06 FOREIGN KEY (departure_id) REFERENCES departure (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA319EB6921');
        $this->addSql('ALTER TABLE departure_aircrew DROP FOREIGN KEY FK_AE6EAD0D7704ED06');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA37704ED06');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE departure');
        $this->addSql('DROP TABLE departure_aircrew');
        $this->addSql('DROP TABLE ticket');
    }
}
