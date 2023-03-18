<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226215458 extends AbstractMigration
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

        $this->addSql('CREATE TABLE lemon_project_domain_model_materialamount (persistence_object_identifier VARCHAR(40) NOT NULL, material VARCHAR(40) DEFAULT NULL, contributionpointsentry VARCHAR(40) DEFAULT NULL, contributionpointsvalue INT NOT NULL, INDEX IDX_64E771CF7CBE7595 (material), INDEX IDX_64E771CF680ABD48 (contributionpointsentry), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lemon_project_domain_model_materialamount ADD CONSTRAINT FK_64E771CF7CBE7595 FOREIGN KEY (material) REFERENCES lemon_project_domain_model_material (persistence_object_identifier)');
        $this->addSql('ALTER TABLE lemon_project_domain_model_materialamount ADD CONSTRAINT FK_64E771CF680ABD48 FOREIGN KEY (contributionpointsentry) REFERENCES lemon_project_domain_model_contributionpointsentry (persistence_object_identifier)');
        $this->addSql('ALTER TABLE lemon_project_domain_model_contributionpointsentry CHANGE createddatetime createdat DATETIME NOT NULL, CHANGE updateddatetime updatedat DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material DROP FOREIGN KEY FK_76011D4680ABD48');
        $this->addSql('DROP INDEX IDX_76011D4680ABD48 ON lemon_project_domain_model_material');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material DROP contributionpointsentry, CHANGE createddatetime createdat DATETIME NOT NULL, CHANGE updateddatetime updatedat DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1027Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1027Platform'."
        );

        $this->addSql('DROP TABLE lemon_project_domain_model_materialamount');
        $this->addSql('ALTER TABLE lemon_project_domain_model_contributionpointsentry CHANGE createdat createddatetime DATETIME NOT NULL, CHANGE updatedat updateddatetime DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material ADD contributionpointsentry VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE createdat createddatetime DATETIME NOT NULL, CHANGE updatedat updateddatetime DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE lemon_project_domain_model_material ADD CONSTRAINT FK_76011D4680ABD48 FOREIGN KEY (contributionpointsentry) REFERENCES lemon_project_domain_model_contributionpointsentry (persistence_object_identifier)');
        $this->addSql('CREATE INDEX IDX_76011D4680ABD48 ON lemon_project_domain_model_material (contributionpointsentry)');
    }
}
