<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316194207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque CHANGE user_created_id user_created_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE user_created_id user_created_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE community CHANGE user_created_id user_created_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compte CHANGE user_created_id user_created_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE folder CHANGE user_created_id user_created_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role CHANGE user_created_id user_created_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque CHANGE user_created_id user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE user_created_id user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE community CHANGE user_created_id user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE compte CHANGE user_created_id user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE folder CHANGE user_created_id user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE role CHANGE user_created_id user_created_id INT NOT NULL');
    }
}
