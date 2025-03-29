<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250329214340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Criar entidade Unidade Endereco';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE unidade_endereco (
                unid_id INT NOT NULL,
                end_id INT NOT NULL,
                PRIMARY KEY(unid_id, end_id)
            )
        ');

        $this->addSql('CREATE INDEX IDX_5E153544A8A42792 ON unidade_endereco (unid_id)');
        $this->addSql('CREATE INDEX IDX_5E153544E2BD8A10 ON unidade_endereco (end_id)');
        $this->addSql(
            'ALTER TABLE unidade_endereco
                ADD CONSTRAINT FK_5E153544A8A42792
                FOREIGN KEY (unid_id)
                REFERENCES unidade (unid_id)
                NOT DEFERRABLE INITIALLY IMMEDIATE
            '
        );
        $this->addSql(
            'ALTER TABLE unidade_endereco
                ADD CONSTRAINT FK_5E153544E2BD8A10
                FOREIGN KEY (end_id)
                REFERENCES endereco (end_id)
                ON DELETE CASCADE
                NOT DEFERRABLE INITIALLY IMMEDIATE
            '
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unidade_endereco DROP CONSTRAINT FK_5E153544A8A42792');
        $this->addSql('ALTER TABLE unidade_endereco DROP CONSTRAINT FK_5E153544E2BD8A10');
        $this->addSql('DROP TABLE unidade_endereco');
    }
}
