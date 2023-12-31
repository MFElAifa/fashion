<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117232838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_brand (user_id INT NOT NULL, brand_id INT NOT NULL, INDEX IDX_FE900200A76ED395 (user_id), INDEX IDX_FE90020044F5D008 (brand_id), PRIMARY KEY(user_id, brand_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_brand ADD CONSTRAINT FK_FE900200A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_brand ADD CONSTRAINT FK_FE90020044F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_brand DROP FOREIGN KEY FK_FE900200A76ED395');
        $this->addSql('ALTER TABLE user_brand DROP FOREIGN KEY FK_FE90020044F5D008');
        $this->addSql('DROP TABLE user_brand');
    }
}
