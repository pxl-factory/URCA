<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204081730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel INT NOT NULL, birthday DATE NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_cours (id INT AUTO_INCREMENT NOT NULL, nom_court VARCHAR(255) NOT NULL, nom_complet VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_cours_module (type_cours_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_E4E78D45B3305F4C (type_cours_id), INDEX IDX_E4E78D45AFC2B591 (module_id), PRIMARY KEY(type_cours_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant (id INT NOT NULL, date_deb DATE NOT NULL, date_fin DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, type_cours_id INT DEFAULT NULL, module_id INT DEFAULT NULL, bulletin_id INT DEFAULT NULL, coeff INT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, INDEX IDX_CFBDFA14B3305F4C (type_cours_id), INDEX IDX_CFBDFA14AFC2B591 (module_id), INDEX IDX_CFBDFA14D1AAB236 (bulletin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bulletin (id INT AUTO_INCREMENT NOT NULL, semestre_id INT DEFAULT NULL, etudiant_id INT DEFAULT NULL, INDEX IDX_2B7D89425577AFDB (semestre_id), INDEX IDX_2B7D8942DDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, ue_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_C24262862E883B1 (ue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, classe VARCHAR(255) NOT NULL, place_exam VARCHAR(255) NOT NULL, annee_master VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nombre_note (id INT AUTO_INCREMENT NOT NULL, type_cours_id INT DEFAULT NULL, module_id INT DEFAULT NULL, nb_note INT NOT NULL, ratio1er_note DOUBLE PRECISION NOT NULL, INDEX IDX_15FB0E3B3305F4C (type_cours_id), INDEX IDX_15FB0E3AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, num_semestre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, semestre_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2E490A9B5577AFDB (semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue_bulletin (ue_id INT NOT NULL, bulletin_id INT NOT NULL, INDEX IDX_308858E562E883B1 (ue_id), INDEX IDX_308858E5D1AAB236 (bulletin_id), PRIMARY KEY(ue_id, bulletin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_cours_module ADD CONSTRAINT FK_E4E78D45B3305F4C FOREIGN KEY (type_cours_id) REFERENCES type_cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_cours_module ADD CONSTRAINT FK_E4E78D45AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14B3305F4C FOREIGN KEY (type_cours_id) REFERENCES type_cours (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14D1AAB236 FOREIGN KEY (bulletin_id) REFERENCES bulletin (id)');
        $this->addSql('ALTER TABLE bulletin ADD CONSTRAINT FK_2B7D89425577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE bulletin ADD CONSTRAINT FK_2B7D8942DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262862E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nombre_note ADD CONSTRAINT FK_15FB0E3B3305F4C FOREIGN KEY (type_cours_id) REFERENCES type_cours (id)');
        $this->addSql('ALTER TABLE nombre_note ADD CONSTRAINT FK_15FB0E3AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE ue_bulletin ADD CONSTRAINT FK_308858E562E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_bulletin ADD CONSTRAINT FK_308858E5D1AAB236 FOREIGN KEY (bulletin_id) REFERENCES bulletin (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60BF396750');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1BF396750');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3BF396750');
        $this->addSql('ALTER TABLE type_cours_module DROP FOREIGN KEY FK_E4E78D45B3305F4C');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14B3305F4C');
        $this->addSql('ALTER TABLE nombre_note DROP FOREIGN KEY FK_15FB0E3B3305F4C');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14D1AAB236');
        $this->addSql('ALTER TABLE ue_bulletin DROP FOREIGN KEY FK_308858E5D1AAB236');
        $this->addSql('ALTER TABLE type_cours_module DROP FOREIGN KEY FK_E4E78D45AFC2B591');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14AFC2B591');
        $this->addSql('ALTER TABLE nombre_note DROP FOREIGN KEY FK_15FB0E3AFC2B591');
        $this->addSql('ALTER TABLE bulletin DROP FOREIGN KEY FK_2B7D8942DDEAB1A3');
        $this->addSql('ALTER TABLE bulletin DROP FOREIGN KEY FK_2B7D89425577AFDB');
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B5577AFDB');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262862E883B1');
        $this->addSql('ALTER TABLE ue_bulletin DROP FOREIGN KEY FK_308858E562E883B1');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE type_cours');
        $this->addSql('DROP TABLE type_cours_module');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE bulletin');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE nombre_note');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE ue_bulletin');
    }
}
