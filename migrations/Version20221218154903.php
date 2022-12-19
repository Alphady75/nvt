<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221218154903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, secteur_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, civilite VARCHAR(40) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, num INT DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, ape_naf VARCHAR(255) DEFAULT NULL, num_tva VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, groupe_client VARCHAR(255) DEFAULT NULL, sous_groupe VARCHAR(255) DEFAULT NULL, resp_facturation VARCHAR(255) DEFAULT NULL, resp_saisie VARCHAR(255) DEFAULT NULL, decodage_adr TINYINT(1) DEFAULT NULL, adresse_valide TINYINT(1) DEFAULT NULL, type_suivi VARCHAR(255) DEFAULT NULL, shippeo VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, sect_appartenance VARCHAR(255) DEFAULT NULL, sect_compte VARCHAR(255) DEFAULT NULL, sect_num_siret VARCHAR(255) DEFAULT NULL, fac_val_journaliere TINYINT(1) DEFAULT NULL, fact_tarif DOUBLE PRECISION DEFAULT NULL, edition VARCHAR(255) NOT NULL, edition_start_at TIME DEFAULT NULL, edition_end_at TIME DEFAULT NULL, fact_mode LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_C7440455A73F0036 (ville_id), INDEX IDX_C74404559F7E4405 (secteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, vehicule_id INT NOT NULL, ville_id INT NOT NULL, secteur_id INT NOT NULL, conducteur_id INT NOT NULL, user_id INT NOT NULL, tarif DOUBLE PRECISION DEFAULT NULL, date_reception DATETIME DEFAULT NULL, date_livraison DATETIME DEFAULT NULL, statut TINYINT(1) DEFAULT NULL, qrcode LONGTEXT DEFAULT NULL, observation LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67D4A4A3511 (vehicule_id), INDEX IDX_6EEAA67DA73F0036 (ville_id), INDEX IDX_6EEAA67D9F7E4405 (secteur_id), INDEX IDX_6EEAA67DF16F4AC6 (conducteur_id), INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_itineraire (commande_id INT NOT NULL, itineraire_id INT NOT NULL, INDEX IDX_D0BEB6F782EA2E54 (commande_id), INDEX IDX_D0BEB6F7A9B853B8 (itineraire_id), PRIMARY KEY(commande_id, itineraire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conducteur (id INT AUTO_INCREMENT NOT NULL, ville_travail_id INT NOT NULL, secteur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, civilite VARCHAR(40) NOT NULL, code VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, memo LONGTEXT DEFAULT NULL, type_contrat VARCHAR(255) NOT NULL, date_entre DATETIME DEFAULT NULL, date_fin_contrat DATETIME DEFAULT NULL, poste VARCHAR(255) DEFAULT NULL, service VARCHAR(255) DEFAULT NULL, entreprise VARCHAR(255) DEFAULT NULL, date_debut_enciennete DATETIME DEFAULT NULL, domicile VARCHAR(255) DEFAULT NULL, telpersonnel VARCHAR(255) DEFAULT NULL, datenaissance DATETIME DEFAULT NULL, numcartetachy VARCHAR(255) DEFAULT NULL, chauffeur TINYINT(1) DEFAULT NULL, type_permis VARCHAR(255) DEFAULT NULL, villenaissance VARCHAR(255) DEFAULT NULL, num_permis VARCHAR(255) DEFAULT NULL, ville_permis VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(255) DEFAULT NULL, num_carte_vital VARCHAR(255) DEFAULT NULL, prenom2 VARCHAR(255) DEFAULT NULL, societe VARCHAR(255) DEFAULT NULL, email_perso VARCHAR(255) DEFAULT NULL, appartenance VARCHAR(255) DEFAULT NULL, contacts_urgence LONGTEXT DEFAULT NULL, taille VARCHAR(255) DEFAULT NULL, pointure VARCHAR(255) DEFAULT NULL, emeteur_passeport LONGTEXT DEFAULT NULL, cadeau_fin_annee TINYINT(1) DEFAULT NULL, statut TINYTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_2367714330A29AA0 (ville_travail_id), INDEX IDX_236771439F7E4405 (secteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itineraire (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, tarif DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_487C9A1119EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, hex_color VARCHAR(7) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_8045251FA73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, parrain_id INT DEFAULT NULL, nom VARCHAR(60) DEFAULT NULL, prenom VARCHAR(60) DEFAULT NULL, genre VARCHAR(5) DEFAULT NULL, apropos VARCHAR(255) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649DE2A7A37 (parrain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, reference VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, hex_color VARCHAR(7) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande_itineraire ADD CONSTRAINT FK_D0BEB6F782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_itineraire ADD CONSTRAINT FK_D0BEB6F7A9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conducteur ADD CONSTRAINT FK_2367714330A29AA0 FOREIGN KEY (ville_travail_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE conducteur ADD CONSTRAINT FK_236771439F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE itineraire ADD CONSTRAINT FK_487C9A1119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE secteur ADD CONSTRAINT FK_8045251FA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DE2A7A37 FOREIGN KEY (parrain_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE itineraire DROP FOREIGN KEY FK_487C9A1119EB6921');
        $this->addSql('ALTER TABLE commande_itineraire DROP FOREIGN KEY FK_D0BEB6F782EA2E54');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF16F4AC6');
        $this->addSql('ALTER TABLE commande_itineraire DROP FOREIGN KEY FK_D0BEB6F7A9B853B8');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559F7E4405');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9F7E4405');
        $this->addSql('ALTER TABLE conducteur DROP FOREIGN KEY FK_236771439F7E4405');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DE2A7A37');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4A4A3511');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A73F0036');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA73F0036');
        $this->addSql('ALTER TABLE conducteur DROP FOREIGN KEY FK_2367714330A29AA0');
        $this->addSql('ALTER TABLE secteur DROP FOREIGN KEY FK_8045251FA73F0036');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_itineraire');
        $this->addSql('DROP TABLE conducteur');
        $this->addSql('DROP TABLE itineraire');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE ville');
    }
}
