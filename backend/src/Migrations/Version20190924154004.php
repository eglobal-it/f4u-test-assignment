<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190924154004 extends AbstractMigration
{
    /**
     * @inheritDoc
     */
    public function up(Schema $schema): void
    {
        $this->createClientsTable($schema);
        $this->createAddressTable($schema);
    }

    /**
     * @inheritDoc
     */
    public function down(Schema $schema): void
    {
        $schema->dropTable('delivery_address');
        $schema->dropTable('clients');
    }

    /**
     * @param Schema $schema
     */
    private function createClientsTable(Schema $schema): void
    {
        $table = $schema->createTable('clients');
        $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $table->addColumn('first_name', 'string', ['length' => 255]);
        $table->addColumn('last_name', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    private function createAddressTable(Schema $schema): void
    {
        $table = $schema->createTable('delivery_address');
        $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement' => true]);
        $table->addColumn('client_id', 'integer', ['unsigned' => true]);
        $table->addColumn('zip_code', 'string', ['length' => 10]);
        $table->addColumn('country', 'string', ['length' => 255]);
        $table->addColumn('city', 'string', ['length' => 255]);
        $table->addColumn('street', 'string', ['length' => 255]);
        $table->addColumn('is_default', 'boolean', ['default' => false]);
        $table->setPrimaryKey(['id']);
        $table->addForeignKeyConstraint(
            'clients',
            ['client_id'],
            ['id'],
            ['onDelete' => 'cascade', 'onUpdate' => 'cascade']
        );
    }
}
