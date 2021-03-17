<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316195903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE folder ADD employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE folder ADD CONSTRAINT FK_ECA209CD1B65292 FOREIGN KEY (employe_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECA209CD1B65292 ON folder (employe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE folder DROP FOREIGN KEY FK_ECA209CD1B65292');
        $this->addSql('DROP INDEX UNIQ_ECA209CD1B65292 ON folder');
        $this->addSql('ALTER TABLE folder DROP employe_id');
    }
}
