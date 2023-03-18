<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226213541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1027Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1027Platform'."
        );

        $this->addSql('ALTER TABLE lemon_project_domain_model_material DROP FOREIGN KEY FK_76011D4BE86F3A3');
        $this->addSql('CREATE TABLE lemon_project_domain_model_contributionpointsentry (persistence_object_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, totalcontributionpoints INT NOT NULL, comment LONGTEXT NOT NULL, createddatetime DATETIME NOT NULL, updateddatetime DATETIME DEFAULT NULL, sortableposition INT DEFAULT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE lemon_project_domain_model_matscalculator');
        $this->addSql('DROP INDEX IDX_76011D4BE86F3A3 ON lemon_project_domain_model_material');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material CHANGE matscalculator contributionpointsentry VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material ADD CONSTRAINT FK_76011D4680ABD48 FOREIGN KEY (contributionpointsentry) REFERENCES lemon_project_domain_model_contributionpointsentry (persistence_object_identifier)');
        $this->addSql('CREATE INDEX IDX_76011D4680ABD48 ON lemon_project_domain_model_material (contributionpointsentry)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1027Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1027Platform'."
        );

        $this->addSql('ALTER TABLE lemon_project_domain_model_material DROP FOREIGN KEY FK_76011D4680ABD48');
        $this->addSql('CREATE TABLE lemon_project_domain_model_matscalculator (persistence_object_identifier VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, createddatetime DATETIME NOT NULL, updateddatetime DATETIME DEFAULT NULL, sortableposition INT DEFAULT NULL, comment LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, totalcontributionpoints INT NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE lemon_project_domain_model_contributionpointsentry');
        $this->addSql('DROP INDEX IDX_76011D4680ABD48 ON lemon_project_domain_model_material');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material CHANGE contributionpointsentry matscalculator VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material ADD CONSTRAINT FK_76011D4BE86F3A3 FOREIGN KEY (matscalculator) REFERENCES lemon_project_domain_model_matscalculator (persistence_object_identifier)');
        $this->addSql('CREATE INDEX IDX_76011D4BE86F3A3 ON lemon_project_domain_model_material (matscalculator)');
    }
}
