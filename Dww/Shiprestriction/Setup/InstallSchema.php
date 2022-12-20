<?php

namespace Dww\Shiprestriction\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * phpcs:ignoreFile
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer
            ->getConnection()
            ->newTable($installer->getTable('dww_shiprestriction_rule'))
            ->addColumn(
                'rule_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true]
            )
            ->addColumn(
                'is_active',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'default' => 0]
            )
         
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false]
            )
            ->addColumn(
                'stores',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['default' => '', 'nullable' => false]
            )
            ->addColumn(
                'cust_groups',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['default' => '', 'nullable' => false]
            )
            ->addColumn(
                'methods',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null, 'nullable' => true]
            )
            ->addColumn(
                'message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['default' => null, 'nullable' => true]
            )
            ->addColumn(
                'carriers',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null, 'nullable' => true]
            );
          
         
        $installer->getConnection()->createTable($table);

       $table = $installer
            ->getConnection()
            ->newTable($installer->getTable('dww_shiprestriction_attribute'))
            ->addColumn(
                'attr_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true]
            )
            ->addColumn(
                'rule_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false]
            )
            ->addColumn(
                'code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['default' => null, 'nullable' => true]
            )
            ->addIndex('rule_id', 'rule_id')
            ->addForeignKey(
                $installer->getFkName(
                    'dww_shiprestriction_attribute',
                    'rule_id',
                    'dww_shiprestriction_rule',
                    'rule_id'
                ),
                'rule_id',
                $installer->getTable('dww_shiprestriction_rule'),
                'rule_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
