<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171014222730 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE response (id VARCHAR(255) NOT NULL, operation_id VARCHAR(255) DEFAULT NULL, definition_id VARCHAR(255) DEFAULT NULL, status_code INT NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_3E7B0BFB44AC3583 (operation_id), INDEX IDX_3E7B0BFBD11EA911 (definition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id VARCHAR(255) NOT NULL, resource_id VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, method VARCHAR(255) NOT NULL, uri VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, consume_formats TINYTEXT NOT NULL COMMENT \'(DC2Type:array)\', produce_formats TINYTEXT NOT NULL COMMENT \'(DC2Type:array)\', parameters TINYTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_1981A66D89329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB44AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBD11EA911 FOREIGN KEY (definition_id) REFERENCES definition (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFB44AC3583');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE operation');
    }
}
