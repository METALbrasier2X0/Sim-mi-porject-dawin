<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190211164531 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, id_etape_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, text_reponse VARCHAR(255) NOT NULL, satisfaction_c INT NOT NULL, reputation_e INT NOT NULL, reputation_p VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E1A574E38 (id_etape_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, id_question_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_5FB6DEC76353B48 (id_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, is_user_id INT DEFAULT NULL, satisfaction_c INT NOT NULL, reputation_p INT NOT NULL, reputation_e INT NOT NULL, creation_partie DATETIME NOT NULL, INDEX IDX_32993751B152555D (is_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solution (id INT AUTO_INCREMENT NOT NULL, id_question_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9F3329DB6353B48 (id_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1A574E38 FOREIGN KEY (id_etape_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751B152555D FOREIGN KEY (is_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE solution ADD CONSTRAINT FK_9F3329DB6353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E1A574E38');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC76353B48');
        $this->addSql('ALTER TABLE solution DROP FOREIGN KEY FK_9F3329DB6353B48');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE solution');
    }
}
