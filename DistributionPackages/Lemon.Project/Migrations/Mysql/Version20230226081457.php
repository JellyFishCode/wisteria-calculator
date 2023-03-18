<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226081457 extends AbstractMigration
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

        $this->addSql('CREATE TABLE lemon_project_domain_model_material (persistence_object_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, contributionpointsvalue INT NOT NULL, createddatetime DATETIME NOT NULL, updateddatetime DATETIME DEFAULT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lemon_project_domain_model_7beae_contributionpointsentries_join (project_material VARCHAR(40) NOT NULL, project_contributionpointsentry VARCHAR(40) NOT NULL, INDEX IDX_88ED4AD41F0FE4E (project_material), INDEX IDX_88ED4AD774671C1 (project_contributionpointsentry), PRIMARY KEY(project_material, project_contributionpointsentry)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join ADD CONSTRAINT FK_88ED4AD41F0FE4E FOREIGN KEY (project_material) REFERENCES lemon_project_domain_model_material (persistence_object_identifier)');
        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join ADD CONSTRAINT FK_88ED4AD774671C1 FOREIGN KEY (project_contributionpointsentry) REFERENCES lemon_project_domain_model_contributionpointsentry (persistence_object_identifier)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1027Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1027Platform'."
        );

        $this->addSql('ALTER TABLE lemon_project_domain_model_7beae_contributionpointsentries_join DROP FOREIGN KEY FK_88ED4AD41F0FE4E');
        $this->addSql('DROP TABLE lemon_project_domain_model_material');
        $this->addSql('DROP TABLE lemon_project_domain_model_7beae_contributionpointsentries_join');
    }
}
