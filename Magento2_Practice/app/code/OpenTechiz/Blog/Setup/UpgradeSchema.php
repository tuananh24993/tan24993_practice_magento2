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
            ->newTable($installer->getTable('opentechiz_blog_comment_approval_notification'))
            ->addColumn('notification_id', Table::TYPE_SMALLINT, null, [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
            ], 'Notificatiom ID')
            ->addColumn('content', Table::TYPE_TEXT, 255, ['nullable => false'], 'Notification Content')
            ->addColumn('user_id', Table::TYPE_SMALLINT, null, ['nullable' => false], 'User ID')
            ->addColumn('post_id', Table::TYPE_SMALLINT, null, ['nullable' => false], 'Post ID')
            ->addColumn('creation_time', Table::TYPE_TIMESTAMP, null, [], 'Created At')
            ->setComment('Comment Notification');
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}