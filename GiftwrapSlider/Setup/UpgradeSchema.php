<?php

namespace Team1\GiftwrapSlider\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $quoteAddressTable = 'quote_address';
        $quoteTable = 'quote';
        $orderTable = 'sales_order';
        $invoiceTable = 'sales_invoice';
        $creditmemoTable = 'sales_creditmemo';

        //Setup two columns for quote, quote_address and order
        //Quote address tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'giftwrap',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' =>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Giftwrap'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'giftwrap_name',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftwrap Name'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'giftmessage',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftmessage'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'hide_price',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '0',
                    'nullable' => true,
                    'comment' =>'Hide Price'
                ]
            );

        //Quote tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'giftwrap',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' =>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Giftwrap'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'giftwrap_name',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftwrap Name'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'giftmessage',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftmessage'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'hide_price',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '0',
                    'nullable' => true,
                    'comment' =>'Hide Price'
                ]
            );

        //Order tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'giftwrap',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' =>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Giftwrap'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'giftwrap_name',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftwrap Name'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'giftmessage',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftmessage'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'hide_price',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '0',
                    'nullable' => true,
                    'comment' =>'Hide Price'
                ]
            );

        //Invoice tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'giftwrap',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' =>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Giftwrap'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'giftwrap_name',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftwrap Name'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'giftmessage',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftmessage'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'hide_price',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '0',
                    'nullable' => true,
                    'comment' =>'Hide Price'
                ]
            );

        //Credit memo tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'giftwrap',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' =>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Giftwrap'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'giftwrap_name',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftwrap Name'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'giftmessage',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '',
                    'nullable' => true,
                    'comment' =>'Giftmessage'
                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'hide_price',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' =>'255',
                    'default' => '0',
                    'nullable' => true,
                    'comment' =>'Hide Price'
                ]
            );


        $setup->endSetup();
    }
}
