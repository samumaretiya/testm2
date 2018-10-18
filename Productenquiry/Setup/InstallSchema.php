<?php


namespace Digital\Productenquiry\Setup;

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
		 * Creating table digital_productenquiry
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('digital_productenquiry')
		)->addColumn(
			'productenquiry_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Entity Id'
		)->addColumn(
			'productname',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Product Name'
		)->addColumn(
			'productsku',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Product SKU'
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
			'companyname',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Company Name'
		)->addColumn(
			'email',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Email Id'
			)->addColumn(
			'telephone',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Phone No'
			)->addColumn(
			'expecteddate',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'expecteddate'
			)->addColumn(
			'expected_people',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'expected_people'
			)->addColumn(
			'occasion',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'occasion'
			)->addColumn(
			'comment',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			'2M',
			['nullable' => true,'default' => null],
			'Comment'
		)->addColumn(
			'created_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
			['nullable' => false],
			'Created At'
		)->addColumn(
			'published_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATE,
			null,
			['nullable' => true,'default' => null],
			'publish date'
		)->addIndex(
			$installer->getIdxName(
				'digital_productenquiry',
				['published_at'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_INDEX
			),
			['published_at'],
			['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_INDEX]
		)->setComment(
			'Productenquiry item'
		);
		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}