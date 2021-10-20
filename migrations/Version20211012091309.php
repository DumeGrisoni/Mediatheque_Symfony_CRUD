<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012091309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe ADD livre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B937D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B937D925CB ON employe (livre_id)');
        $this->addSql('ALTER TABLE inscrit ADD livre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscrit ADD CONSTRAINT FK_927FA36537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_927FA36537D925CB ON inscrit (livre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B937D925CB');
        $this->addSql('DROP INDEX IDX_F804D3B937D925CB ON employe');
        $this->addSql('ALTER TABLE employe DROP livre_id');
        $this->addSql('ALTER TABLE inscrit DROP FOREIGN KEY FK_927FA36537D925CB');
        $this->addSql('DROP INDEX UNIQ_927FA36537D925CB ON inscrit');
        $this->addSql('ALTER TABLE inscrit DROP livre_id');
    }
}
