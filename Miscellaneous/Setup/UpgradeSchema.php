<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2018 Amasty (https://www.amasty.com)
 * @package Amasty_Shopby
 */


namespace Digital\Miscellaneous\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2', '<')) {
			$tableName = $setup->getTable('blockoutdates');
			$table = $setup->getConnection()
				->newTable($tableName)
				->addColumn(
					'entity_id',
					Table::TYPE_SMALLINT,
					null,
					['identity' => true, 'nullable' => false, 'primary' => true]
				)
				->addColumn('product_id', Table::TYPE_SMALLINT, null, ['nullable' => false])
				->addColumn('blocked_dates', Table::TYPE_TEXT, 255, ['nullable' => false, 'default' => false]);

			$setup->getConnection()->createTable($table);
        }

		$setup->endSetup();
    }
}
