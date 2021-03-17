<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316190400 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE banque ADD user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE banque ADD CONSTRAINT FK_B1F6CB3CF987D8A8 FOREIGN KEY (user_created_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B1F6CB3CF987D8A8 ON banque (user_created_id)');
        $this->addSql('ALTER TABLE client ADD user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455F987D8A8 FOREIGN KEY (user_created_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C7440455F987D8A8 ON client (user_created_id)');
        $this->addSql('DROP INDEX UNIQ_1B604033E7927C74 ON community');
        $this->addSql('ALTER TABLE community ADD user_created_id INT NOT NULL, DROP matricule, DROP nom, DROP prenom, DROP genre, DROP date_naiss, DROP adresse, DROP telephone, DROP sm, DROP email, DROP activite, DROP lieu_naiss, DROP nationality, DROP type_piece_identity, DROP numero_piece_identity, DROP profession, DROP date_delivrance, DROP taille_famille, DROP other_contact_full_name, DROP other_contact_phone, DROP other_contact_parental_bond, DROP insurance_eligible_at, DROP condition_adhesion, DROP partage_donnees');
        $this->addSql('ALTER TABLE community ADD CONSTRAINT FK_1B604033F987D8A8 FOREIGN KEY (user_created_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1B604033F987D8A8 ON community (user_created_id)');
        $this->addSql('DROP INDEX UNIQ_CFF65260E7927C74 ON compte');
        $this->addSql('ALTER TABLE compte ADD user_created_id INT NOT NULL, DROP matricule, DROP nom, DROP prenom, DROP genre, DROP date_naiss, DROP adresse, DROP telephone, DROP sm, DROP email, DROP activite, DROP lieu_naiss, DROP nationality, DROP type_piece_identity, DROP numero_piece_identity, DROP profession, DROP date_delivrance, DROP taille_famille, DROP other_contact_full_name, DROP other_contact_phone, DROP other_contact_parental_bond, DROP insurance_eligible_at, DROP condition_adhesion, DROP partage_donnees');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260F987D8A8 FOREIGN KEY (user_created_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CFF65260F987D8A8 ON compte (user_created_id)');
        $this->addSql('ALTER TABLE folder ADD user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE folder ADD CONSTRAINT FK_ECA209CDF987D8A8 FOREIGN KEY (user_created_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_ECA209CDF987D8A8 ON folder (user_created_id)');
        $this->addSql('ALTER TABLE role ADD user_created_id INT NOT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AF987D8A8 FOREIGN KEY (user_created_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_57698A6AF987D8A8 ON role (user_created_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_role');
        $this->addSql('ALTER TABLE banque DROP FOREIGN KEY FK_B1F6CB3CF987D8A8');
        $this->addSql('DROP INDEX IDX_B1F6CB3CF987D8A8 ON banque');
        $this->addSql('ALTER TABLE banque DROP user_created_id');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455F987D8A8');
        $this->addSql('DROP INDEX IDX_C7440455F987D8A8 ON client');
        $this->addSql('ALTER TABLE client DROP user_created_id');
        $this->addSql('ALTER TABLE community DROP FOREIGN KEY FK_1B604033F987D8A8');
        $this->addSql('DROP INDEX IDX_1B604033F987D8A8 ON community');
        $this->addSql('ALTER TABLE community ADD matricule VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD genre VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD date_naiss DATETIME DEFAULT NULL, ADD adresse VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone INT DEFAULT NULL, ADD sm VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD activite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD lieu_naiss VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD nationality VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD type_piece_identity VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD numero_piece_identity VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD profession VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD date_delivrance DATETIME DEFAULT NULL, ADD taille_famille INT DEFAULT NULL, ADD other_contact_full_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD other_contact_phone INT DEFAULT NULL, ADD other_contact_parental_bond VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD insurance_eligible_at DATETIME DEFAULT NULL, ADD condition_adhesion TINYINT(1) NOT NULL, ADD partage_donnees TINYINT(1) NOT NULL, DROP user_created_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1B604033E7927C74 ON community (email)');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260F987D8A8');
        $this->addSql('DROP INDEX IDX_CFF65260F987D8A8 ON compte');
        $this->addSql('ALTER TABLE compte ADD matricule VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD genre VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD date_naiss DATETIME DEFAULT NULL, ADD adresse VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD telephone INT DEFAULT NULL, ADD sm VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD activite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD lieu_naiss VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD nationality VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD type_piece_identity VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD numero_piece_identity VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD profession VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD date_delivrance DATETIME DEFAULT NULL, ADD taille_famille INT DEFAULT NULL, ADD other_contact_full_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD other_contact_phone INT DEFAULT NULL, ADD other_contact_parental_bond VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD insurance_eligible_at DATETIME DEFAULT NULL, ADD condition_adhesion TINYINT(1) NOT NULL, ADD partage_donnees TINYINT(1) NOT NULL, DROP user_created_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF65260E7927C74 ON compte (email)');
        $this->addSql('ALTER TABLE folder DROP FOREIGN KEY FK_ECA209CDF987D8A8');
        $this->addSql('DROP INDEX IDX_ECA209CDF987D8A8 ON folder');
        $this->addSql('ALTER TABLE folder DROP user_created_id');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AF987D8A8');
        $this->addSql('DROP INDEX IDX_57698A6AF987D8A8 ON role');
        $this->addSql('ALTER TABLE role DROP user_created_id');
    }
}
