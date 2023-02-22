<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222043228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account_detail (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image VARCHAR(255) DEFAULT NULL, birthday DATE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_932B1E0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, event_name VARCHAR(255) NOT NULL, event_start_day DATE NOT NULL, event_end_day DATE NOT NULL, event_detail VARCHAR(255) DEFAULT NULL, event_image VARCHAR(255) DEFAULT NULL, create_day DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_registration (id INT AUTO_INCREMENT NOT NULL, phonenumber VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration_store (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, student INT NOT NULL, INDEX IDX_70FDF89F71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account_detail ADD CONSTRAINT FK_932B1E0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registration_store ADD CONSTRAINT FK_70FDF89F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account_detail DROP FOREIGN KEY FK_932B1E0A76ED395');
        $this->addSql('ALTER TABLE registration_store DROP FOREIGN KEY FK_70FDF89F71F7E88B');
        $this->addSql('DROP TABLE account_detail');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_registration');
        $this->addSql('DROP TABLE registration_store');
        $this->addSql('DROP TABLE user');
    }
}
