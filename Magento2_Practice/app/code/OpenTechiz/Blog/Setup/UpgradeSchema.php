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
        $installer->getConnection()->addColumn($tableName, 'email', [
            'type' => Table::TYPE_TEXT,
            'nullable' => false,
            255,
            'comment' => 'Email'
        ]);
        $installer->endSetup();
    }
}