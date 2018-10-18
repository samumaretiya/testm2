<?php


namespace Digital\Contactus\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
		$installer = $setup;
		$installer->startSetup();

		/**
		 * Creating table digital_contactus
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('digital_contactus')
		)->addColumn(
			'contactus_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Contactus Id'
		)->addColumn(
			'name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'First Name'
		)->addColumn(
			'last_name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Last Name'
		)->addColumn(
			'email',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Email'
		)->addColumn(
			'contact',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'contact Number'
		)->addColumn(
			'enquiry_type',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'enquiry_type'
		)->addColumn(
			'occasion',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'occasion'
		)->addColumn(
			'receive_newsletter',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			['nullable' => true,'default' => '0'],
			'receive_newsletter'
		)->addColumn(
			'message',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			'2M',
			['nullable' => true,'default' => null],
			'Message'
		)->addColumn(
			'created_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
			['nullable' => false],
			'Created At'
		);
		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}