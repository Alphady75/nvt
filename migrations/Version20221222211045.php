<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222211045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destination ADD adresse_livraison_id INT DEFAULT NULL, ADD date_chargement DATETIME DEFAULT NULL, ADD date_livraison DATETIME DEFAULT NULL, CHANGE name adresse_chargement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAABE2F0A35 FOREIGN KEY (adresse_livraison_id) REFERENCES itineraire (id)');
        $this->addSql('CREATE INDEX IDX_3EC63EAABE2F0A35 ON destination (adresse_livraison_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAABE2F0A35');
        $this->addSql('DROP INDEX IDX_3EC63EAABE2F0A35 ON destination');
        $this->addSql('ALTER TABLE destination DROP adresse_livraison_id, DROP date_chargement, DROP date_livraison, CHANGE adresse_chargement name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
