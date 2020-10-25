<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025162656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aircraft DROP FOREIGN KEY FK_13D96729737452E1');
        $this->addSql('DROP INDEX IDX_13D96729737452E1 ON aircraft');
        $this->addSql('ALTER TABLE aircraft ADD model_id INT DEFAULT NULL, DROP model_name');
        $this->addSql('ALTER TABLE aircraft ADD CONSTRAINT FK_13D967297975B7E7 FOREIGN KEY (model_id) REFERENCES aircraft_model (id)');
        $this->addSql('CREATE INDEX IDX_13D967297975B7E7 ON aircraft (model_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aircraft DROP FOREIGN KEY FK_13D967297975B7E7');
        $this->addSql('DROP INDEX IDX_13D967297975B7E7 ON aircraft');
        $this->addSql('ALTER TABLE aircraft ADD model_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP model_id');
        $this->addSql('ALTER TABLE aircraft ADD CONSTRAINT FK_13D96729737452E1 FOREIGN KEY (model_name) REFERENCES aircraft_model (name)');
        $this->addSql('CREATE INDEX IDX_13D96729737452E1 ON aircraft (model_name)');
    }
}
