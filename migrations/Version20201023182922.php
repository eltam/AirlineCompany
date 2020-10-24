<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023182922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE air_crew (id INT AUTO_INCREMENT NOT NULL, num_secu VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, salary INT NOT NULL, flying_hours INT NOT NULL, function VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ground_employee (id INT AUTO_INCREMENT NOT NULL, num_secu VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, salary INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pilote (id INT AUTO_INCREMENT NOT NULL, num_secu VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, salary INT NOT NULL, flying_hours INT NOT NULL, license VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE air_crew');
        $this->addSql('DROP TABLE ground_employee');
        $this->addSql('DROP TABLE pilote');
    }
}
