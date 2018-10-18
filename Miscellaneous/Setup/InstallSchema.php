<?php

namespace Digital\Miscellaneous\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
/**
 * Class InstallSchema
 *
 * @category Magestore
 * @package  Magestore_OneStepCheckout
 * @module   OneStepCheckout
 * @author   Magestore Developer
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
		
   		/** Quote Level Attribute Start Here*/
		
		    $tableName = $setup->getTable('quote');
			if ($setup->getConnection()->isTableExists($tableName) == true) {
				
				$setup->getConnection()->addColumn(
													$tableName,
													'adults',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Adults',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'kids',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Kids',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'concession',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Concession',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'family',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Family',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'entree',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Entree',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'maincourse',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Maincourse',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'cruisename',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Cruisename',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'bookingdate',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Bookingdate',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'starttime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Starttime',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'endtime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Endtime',
													]
												  );
			} 
		
		/** Quote Level Attribute End Here */
        
		/** Quote Item Level Attribute Start Here*/
		
			$tableName = $setup->getTable('quote_item');
			if ($setup->getConnection()->isTableExists($tableName) == true) {
				
				$setup->getConnection()->addColumn(
													$tableName,
													'adults',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Adults',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'kids',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Kids',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'concession',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Concession',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'family',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Family',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'entree',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Entree',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'maincourse',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Maincourse',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'cruisename',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Cruisename',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'bookingdate',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Bookingdate',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'starttime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Starttime',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'endtime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Endtime',
													]
												  );
			} 
		
		/** Quote Item Level Attribute End Here */
		
   		/** Sales Order Level Attribute Start Here */
		
			$tableName = $setup->getTable('sales_order');
			if ($setup->getConnection()->isTableExists($tableName) == true) {
				
				$setup->getConnection()->addColumn(
													$tableName,
													'adults',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Adults',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'kids',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Kids',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'concession',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Concession',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'family',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Family',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'entree',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Entree',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'maincourse',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Maincourse',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'cruisename',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Cruisename',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'bookingdate',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Bookingdate',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'starttime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Starttime',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'endtime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Endtime',
													]
												  );
			} 
		
		/** Sales Order Level Attribute End Here */
		
		/** Sales Order Item Level Attribute Start Here */
		
			$tableName = $setup->getTable('sales_order_item');
			if ($setup->getConnection()->isTableExists($tableName) == true) {
				
				$setup->getConnection()->addColumn(
													$tableName,
													'adults',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Adults',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'kids',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Kids',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'concession',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Concession',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'family',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Family',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'entree',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Entree',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'maincourse',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Maincourse',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'cruisename',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Cruisename',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'bookingdate',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Bookingdate',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'starttime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Starttime',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'endtime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Endtime',
													]
												  );
			}
		
		/** Sales Order Item Level Attribute End Here */
		
		/** Sales Invoice Level Attribute Start Here */
		
		    $tableName = $setup->getTable('sales_invoice');
			if ($setup->getConnection()->isTableExists($tableName) == true) {
				
				$setup->getConnection()->addColumn(
													$tableName,
													'adults',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Adults',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'kids',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Kids',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'concession',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Concession',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'family',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Family',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'entree',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Entree',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'maincourse',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Maincourse',
													]
												  );
				
				$setup->getConnection()->addColumn(
													$tableName,
													'cruisename',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Cruisename',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'bookingdate',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Bookingdate',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'starttime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Starttime',
													]
												  );
				$setup->getConnection()->addColumn(
													$tableName,
													'endtime',
													[
														'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
														'length' => 255,
														'comment' => 'Endtime',
													]
												  );
			} 
		
		/** Sales Invoice Level Attribute End Here */
		
		$installer->endSetup();
    }
}