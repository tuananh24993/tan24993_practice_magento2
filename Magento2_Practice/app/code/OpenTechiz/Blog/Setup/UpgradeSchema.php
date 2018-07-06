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

        $table = $installer->getConnection()
            ->newTable($installer->getTable('opentechiz_blog_comment'))
            ->addColumn(
                'comment_id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Comment ID'
            )
            ->addColumn('content', Table::TYPE_TEXT, 255, [], 'Comment Content')
            ->addColumn('author', Table::TYPE_TEXT, null , [], 'Author')
            ->addColumn('post_id', Table::TYPE_INTEGER, null , [], 'Post ID')
            ->addColumn('creation_time', Table::TYPE_TIMESTAMP, null,[
                'nullable' => false,
                'default' => Table::TIMESTAMP_INIT
            ], 'Comment Creation Time')
            ->setComment('OpenTechiz Blog Comments');
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}