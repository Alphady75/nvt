<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222120843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, pal_europe_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, civilite VARCHAR(40) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, num INT DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, ape_naf VARCHAR(255) DEFAULT NULL, num_tva VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, groupe_client VARCHAR(255) DEFAULT NULL, sous_groupe VARCHAR(255) DEFAULT NULL, resp_facturation VARCHAR(255) DEFAULT NULL, resp_saisie VARCHAR(255) DEFAULT NULL, decodage_adr TINYINT(1) DEFAULT NULL, adresse_valide TINYINT(1) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, sect_appartenance VARCHAR(255) DEFAULT NULL, sect_compte VARCHAR(255) DEFAULT NULL, secteur VARCHAR(255) DEFAULT NULL, sect_num_siret VARCHAR(255) DEFAULT NULL, fac_val_journaliere TINYINT(1) DEFAULT NULL, fact_tarif DOUBLE PRECISION DEFAULT NULL, edition VARCHAR(255) DEFAULT NULL, edition_start_at DATETIME DEFAULT NULL, edition_end_at DATETIME DEFAULT NULL, fact_mode LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', memo_trans LONGTEXT DEFAULT NULL, ind_feuille_route LONGTEXT DEFAULT NULL, cont_fonction VARCHAR(255) DEFAULT NULL, cont_fix VARCHAR(255) DEFAULT NULL, cont_fax VARCHAR(255) DEFAULT NULL, demandes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', mail_sms LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', duplication_sms LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', tol_attente_cha INT DEFAULT NULL, tol_retard_cha INT DEFAULT NULL, cal_attante_cha VARCHAR(255) DEFAULT NULL, tol_attente_liv INT DEFAULT NULL, tol_retard_liv INT DEFAULT NULL, cal_attante_liv VARCHAR(255) DEFAULT NULL, plan_char TINYINT(1) DEFAULT NULL, plan_code_char TINYINT(1) DEFAULT NULL, plan_sup_char VARCHAR(255) DEFAULT NULL, plan_nb_car_char INT DEFAULT NULL, plan_vide_char TINYINT(1) DEFAULT NULL, plan_ref_client_char TINYINT(1) DEFAULT NULL, plan_sup2_char VARCHAR(255) DEFAULT NULL, plan_nb_car2_char INT DEFAULT NULL, plan_liv TINYINT(1) DEFAULT NULL, plan_liv_code TINYINT(1) DEFAULT NULL, plan_liv_sup VARCHAR(255) DEFAULT NULL, plan_liv_nb_car INT DEFAULT NULL, plan_liv_ref_client TINYINT(1) DEFAULT NULL, plan_liv_sup2 VARCHAR(255) DEFAULT NULL, feuille_char TINYINT(1) DEFAULT NULL, feuille_code_char TINYINT(1) DEFAULT NULL, feuille_sup_char VARCHAR(255) DEFAULT NULL, feuille_nb_car_char INT DEFAULT NULL, feuille_vide_char TINYINT(1) DEFAULT NULL, feuille_ref_client_char TINYINT(1) DEFAULT NULL, feuille_liv TINYINT(1) DEFAULT NULL, feuille_liv_code TINYINT(1) DEFAULT NULL, feuille_liv_sup VARCHAR(255) DEFAULT NULL, feuille_liv_nb_car INT DEFAULT NULL, feuille_liv_ref_client TINYINT(1) DEFAULT NULL, compt_four_tr_cpt VARCHAR(255) DEFAULT NULL, compt_four_cc_multi TINYINT(1) DEFAULT NULL, compt_four_mod_reg VARCHAR(255) DEFAULT NULL, compt_four_type_reg VARCHAR(255) DEFAULT NULL, compt_four_type_reg_parc VARCHAR(255) DEFAULT NULL, compt_four_jours_paiement DATETIME DEFAULT NULL, compt_four_act_achat VARCHAR(255) DEFAULT NULL, compt_four_fact_aout TINYINT(1) DEFAULT NULL, compt_four_certif_start_at DATETIME DEFAULT NULL, compt_four_certif_end_at DATETIME DEFAULT NULL, compt_four_ref VARCHAR(255) DEFAULT NULL, compt_client_tr_cpt VARCHAR(255) DEFAULT NULL, compt_client_cc_multi TINYINT(1) DEFAULT NULL, compt_client_mod_reg VARCHAR(255) DEFAULT NULL, compt_client_type_reg VARCHAR(255) DEFAULT NULL, compt_client_type_reg_parc VARCHAR(255) DEFAULT NULL, compt_client_jours_paiement DATETIME DEFAULT NULL, compt_client_act_vente VARCHAR(255) DEFAULT NULL, compt_client_fact_aout TINYINT(1) DEFAULT NULL, compt_client_certif_start_at DATETIME DEFAULT NULL, compt_client_certif_end_at DATETIME DEFAULT NULL, compt_client_ref VARCHAR(255) DEFAULT NULL, relance_nom VARCHAR(255) DEFAULT NULL, relance_tel VARCHAR(255) DEFAULT NULL, relance_tel2 VARCHAR(255) DEFAULT NULL, relance_email VARCHAR(255) DEFAULT NULL, relance_memo LONGTEXT DEFAULT NULL, relance_jours DATETIME DEFAULT NULL, adresse_type VARCHAR(255) DEFAULT NULL, adresse_code VARCHAR(255) DEFAULT NULL, adresse_nom VARCHAR(255) DEFAULT NULL, adresse_dep VARCHAR(255) DEFAULT NULL, adresse_ref VARCHAR(255) DEFAULT NULL, adresse_ville VARCHAR(255) DEFAULT NULL, compt_client_compte VARCHAR(10) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_C744045589D1F15 (pal_europe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, vehicule_id INT NOT NULL, conducteur_id INT NOT NULL, user_id INT NOT NULL, itineraire_id INT DEFAULT NULL, tarif DOUBLE PRECISION DEFAULT NULL, date_reception DATETIME DEFAULT NULL, date_livraison DATETIME DEFAULT NULL, qrcode LONGTEXT DEFAULT NULL, observation LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67D4A4A3511 (vehicule_id), INDEX IDX_6EEAA67DF16F4AC6 (conducteur_id), INDEX IDX_6EEAA67DA76ED395 (user_id), INDEX IDX_6EEAA67DA9B853B8 (itineraire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_destination (commande_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_7737BBCB82EA2E54 (commande_id), INDEX IDX_7737BBCB816C6140 (destination_id), PRIMARY KEY(commande_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conducteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, civilite VARCHAR(40) NOT NULL, code VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, memo LONGTEXT DEFAULT NULL, type_contrat VARCHAR(255) NOT NULL, date_entre DATETIME DEFAULT NULL, date_fin_contrat DATETIME DEFAULT NULL, poste VARCHAR(255) DEFAULT NULL, service VARCHAR(255) DEFAULT NULL, entreprise VARCHAR(255) DEFAULT NULL, date_debut_enciennete DATETIME DEFAULT NULL, domicile VARCHAR(255) DEFAULT NULL, telpersonnel VARCHAR(255) DEFAULT NULL, datenaissance DATETIME DEFAULT NULL, numcartetachy VARCHAR(255) DEFAULT NULL, chauffeur TINYINT(1) DEFAULT NULL, type_permis VARCHAR(255) DEFAULT NULL, villenaissance VARCHAR(255) DEFAULT NULL, num_permis VARCHAR(255) DEFAULT NULL, ville_permis VARCHAR(255) DEFAULT NULL, nationalite VARCHAR(255) DEFAULT NULL, num_carte_vital VARCHAR(255) DEFAULT NULL, prenom2 VARCHAR(255) DEFAULT NULL, societe VARCHAR(255) DEFAULT NULL, email_perso VARCHAR(255) DEFAULT NULL, appartenance VARCHAR(255) DEFAULT NULL, contacts_urgence LONGTEXT DEFAULT NULL, taille VARCHAR(255) DEFAULT NULL, pointure VARCHAR(255) DEFAULT NULL, emeteur_passeport LONGTEXT DEFAULT NULL, cadeau_fin_annee TINYINT(1) DEFAULT NULL, statut TINYTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, document VARCHAR(255) NOT NULL, statut TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_FE86641019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itineraire (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, tarif DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, link VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_487C9A1119EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pal_europe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, parrain_id INT DEFAULT NULL, nom VARCHAR(60) DEFAULT NULL, prenom VARCHAR(60) DEFAULT NULL, genre VARCHAR(5) DEFAULT NULL, apropos VARCHAR(255) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649DE2A7A37 (parrain_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, reference VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045589D1F15 FOREIGN KEY (pal_europe_id) REFERENCES pal_europe (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id)');
        $this->addSql('ALTER TABLE commande_destination ADD CONSTRAINT FK_7737BBCB82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_destination ADD CONSTRAINT FK_7737BBCB816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE itineraire ADD CONSTRAINT FK_487C9A1119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DE2A7A37 FOREIGN KEY (parrain_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE itineraire DROP FOREIGN KEY FK_487C9A1119EB6921');
        $this->addSql('ALTER TABLE commande_destination DROP FOREIGN KEY FK_7737BBCB82EA2E54');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF16F4AC6');
        $this->addSql('ALTER TABLE commande_destination DROP FOREIGN KEY FK_7737BBCB816C6140');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA9B853B8');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045589D1F15');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DE2A7A37');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4A4A3511');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_destination');
        $this->addSql('DROP TABLE conducteur');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE itineraire');
        $this->addSql('DROP TABLE pal_europe');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicule');
    }
}
