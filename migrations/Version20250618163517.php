<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250618163517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE product_size (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, size VARCHAR(20) NOT NULL, INDEX IDX_7A2806CB4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reassort_line (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, location_id INT NOT NULL, size VARCHAR(20) NOT NULL, quantity INT NOT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_88BB13144584665A (product_id), INDEX IDX_88BB131464D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_size ADD CONSTRAINT FK_7A2806CB4584665A FOREIGN KEY (product_id) REFERENCES product (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reassort_line ADD CONSTRAINT FK_88BB13144584665A FOREIGN KEY (product_id) REFERENCES product (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reassort_line ADD CONSTRAINT FK_88BB131464D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product_size DROP FOREIGN KEY FK_7A2806CB4584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reassort_line DROP FOREIGN KEY FK_88BB13144584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reassort_line DROP FOREIGN KEY FK_88BB131464D218E
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product_size
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reassort_line
        SQL);
    }
}
