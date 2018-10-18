<?php 

namespace Digital\Faqs\Setup;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Digital\Faqs\Setup\InstallSchema as StorelocatorShema;
 
class UpgradeSchema implements UpgradeSchemaInterface
{     
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
       $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->addColumnToTable($setup);
        }

        $installer->endSetup();
    }
    public function addColumnToTable(SchemaSetupInterface $setup)
    { 
        $setup->getConnection()->addColumn(
            $setup->getTable('faq'),
            'faq_type',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'nullable' => false,
                'comment' => 'Faq Type',
                'default' => 0                
            ]
        );   
    }
}
