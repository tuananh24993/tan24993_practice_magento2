<?php
namespace OpenTechiz\Blog\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements  UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context){
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('opentechiz_blog_comment');
        $installer->getConnection()->addColumn($tableName, 'status', [
            'type' => Table::TYPE_SMALLINT,
            'nullable' => false,
            'default' => 0,
            'comment' => 'Status'
        ]);
        $installer->endSetup();
    }
}