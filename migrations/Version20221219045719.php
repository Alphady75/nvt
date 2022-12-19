<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219045719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pal_europe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD pal_europe_id INT DEFAULT NULL, ADD tol_attente_cha INT DEFAULT NULL, ADD tol_retard_cha INT DEFAULT NULL, ADD cal_attante_cha VARCHAR(255) DEFAULT NULL, ADD tol_attente_liv INT DEFAULT NULL, ADD tol_retard_liv INT DEFAULT NULL, ADD cal_attante_liv INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045589D1F15 FOREIGN KEY (pal_europe_id) REFERENCES pal_europe (id)');
        $this->addSql('CREATE INDEX IDX_C744045589D1F15 ON client (pal_europe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045589D1F15');
        $this->addSql('DROP TABLE pal_europe');
        $this->addSql('DROP INDEX IDX_C744045589D1F15 ON client');
        $this->addSql('ALTER TABLE client DROP pal_europe_id, DROP tol_attente_cha, DROP tol_retard_cha, DROP cal_attante_cha, DROP tol_attente_liv, DROP tol_retard_liv, DROP cal_attante_liv');
    }
}
