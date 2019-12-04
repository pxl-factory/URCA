<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204081904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD mon_projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B018F9FC FOREIGN KEY (mon_projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B018F9FC ON user (mon_projet_id)');
        $this->addSql('ALTER TABLE projet ADD enseignant_id INT DEFAULT NULL, ADD nom VARCHAR(255) NOT NULL, ADD contenu LONGTEXT NOT NULL, ADD date_deb DATE DEFAULT NULL, ADD taile_groupe_etudiant INT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9E455FCC0 ON projet (enseignant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9E455FCC0');
        $this->addSql('DROP INDEX IDX_50159CA9E455FCC0 ON projet');
        $this->addSql('ALTER TABLE projet DROP enseignant_id, DROP nom, DROP contenu, DROP date_deb, DROP taile_groupe_etudiant');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B018F9FC');
        $this->addSql('DROP INDEX IDX_8D93D649B018F9FC ON user');
        $this->addSql('ALTER TABLE user DROP mon_projet_id');
    }
}
