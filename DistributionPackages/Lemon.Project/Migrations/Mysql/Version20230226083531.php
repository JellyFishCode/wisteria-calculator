<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226083531 extends AbstractMigration
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

        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join DROP FOREIGN KEY FK_88ED4AD774671C1');
        $this->addSql('CREATE TABLE lemon_project_domain_model_matscalculator (persistence_object_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, createddatetime DATETIME NOT NULL, updateddatetime DATETIME DEFAULT NULL, sortableposition INT DEFAULT NULL, comment LONGTEXT NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE lemon_project_domain_model_contributionpointsentry');
        $this->addSql('DROP INDEX IDX_88ED4AD774671C1 ON lemon_project_domain_model_7beae_contributionpointsentries_join');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join CHANGE project_contributionpointsentry project_matscalculator VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join ADD CONSTRAINT FK_88ED4AD5731C701 FOREIGN KEY (project_matscalculator) REFERENCES lemon_project_domain_model_matscalculator (persistence_object_identifier)');
        $this->addSql('CREATE INDEX IDX_88ED4AD5731C701 ON lemon_project_domain_model_7beae_contributionpointsentries_join (project_matscalculator)');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join ADD PRIMARY KEY (project_material, project_matscalculator)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1027Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1027Platform'."
        );

        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join DROP FOREIGN KEY FK_88ED4AD5731C701');
        $this->addSql('CREATE TABLE lemon_project_domain_model_contributionpointsentry (persistence_object_identifier VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, createddatetime DATETIME NOT NULL, updateddatetime DATETIME DEFAULT NULL, sortableposition INT DEFAULT NULL, comment LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE lemon_project_domain_model_matscalculator');
        $this->addSql('DROP INDEX IDX_88ED4AD5731C701 ON lemon_project_domain_model_7beae_contributionpointsentries_join');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join CHANGE project_matscalculator project_contributionpointsentry VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join ADD CONSTRAINT FK_88ED4AD774671C1 FOREIGN KEY (project_contributionpointsentry) REFERENCES lemon_project_domain_model_contributionpointsentry (persistence_object_identifier)');
        $this->addSql('CREATE INDEX IDX_88ED4AD774671C1 ON lemon_project_domain_model_7beae_contributionpointsentries_join (project_contributionpointsentry)');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join ADD PRIMARY KEY (project_material, project_contributionpointsentry)');
    }
}
