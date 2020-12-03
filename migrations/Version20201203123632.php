<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203123632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE air_crew ADD city VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, CHANGE address street VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ground_employee ADD city VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, CHANGE address street VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE pilot ADD city VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, CHANGE address street VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE air_crew ADD address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP street, DROP city, DROP country');
        $this->addSql('ALTER TABLE ground_employee ADD address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP street, DROP city, DROP country');
        $this->addSql('ALTER TABLE pilot ADD address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP street, DROP city, DROP country');
    }
}
