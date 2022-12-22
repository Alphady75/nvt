<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222210608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA9B853B8');
        $this->addSql('DROP INDEX IDX_6EEAA67DA9B853B8 ON commande');
        $this->addSql('ALTER TABLE commande DROP itineraire_id');
        $this->addSql('ALTER TABLE destination DROP description');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD itineraire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA9B853B8 ON commande (itineraire_id)');
        $this->addSql('ALTER TABLE destination ADD description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
