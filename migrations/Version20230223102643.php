<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223102643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_registration ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_registration ADD CONSTRAINT FK_8FBBAD54A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8FBBAD54A76ED395 ON event_registration (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_registration DROP FOREIGN KEY FK_8FBBAD54A76ED395');
        $this->addSql('DROP INDEX IDX_8FBBAD54A76ED395 ON event_registration');
        $this->addSql('ALTER TABLE event_registration DROP user_id');
    }
}
