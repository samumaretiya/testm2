<?php

namespace Digital\Foodneeds\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0){

			$installer->run('create table foodneed(
				foodneed_id int not null auto_increment,
				choice_of_entree varchar(100),
				choice_of_main_course varchar(100),
				food_price varchar(100),
				rank varchar(10),
				status varchar(100),
				created_time timestamp,
				updated_time timestamp,
				primary key(foodneed_id))'
			);
		}
        $installer->endSetup();
    }
}