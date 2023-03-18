<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226211412 extends AbstractMigration
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

        $this->addSql('DROP TABLE lemon_project_domain_model_7beae_contributionpointsentries_join');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material ADD matscalculator VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material ADD CONSTRAINT FK_76011D4BE86F3A3 FOREIGN KEY (matscalculator) REFERENCES lemon_project_domain_model_matscalculator (persistence_object_identifier)');
        $this->addSql('CREATE INDEX IDX_76011D4BE86F3A3 ON lemon_project_domain_model_material (matscalculator)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1027Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1027Platform'."
        );

        $this->addSql('CREATE TABLE lemon_project_domain_model_7beae_contributionpointsentries_join (project_material VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, project_matscalculator VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_88ED4AD41F0FE4E (project_material), INDEX IDX_88ED4AD5731C701 (project_matscalculator), PRIMARY KEY(project_material, project_matscalculator)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join ADD CONSTRAINT FK_88ED4AD41F0FE4E FOREIGN KEY (project_material) REFERENCES lemon_project_domain_model_material (persistence_object_identifier)');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join ADD CONSTRAINT FK_88ED4AD5731C701 FOREIGN KEY (project_matscalculator) REFERENCES lemon_project_domain_model_matscalculator (persistence_object_identifier)');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material DROP FOREIGN KEY FK_76011D4BE86F3A3');
        $this->addSql('DROP INDEX IDX_76011D4BE86F3A3 ON lemon_project_domain_model_material');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material DROP matscalculator');
    }
}
