<?php

/**
 * Oggetto Blog extension for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto Blog module to newer versions in the future.
 * If you wish to customize the Oggetto Blog module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @copyright  Copyright (C) 2012 Oggetto Web (http://oggettoweb.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Setup
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Model
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Model_Entity_Setup extends Mage_Eav_Model_Entity_Setup
{

    /**
     * Create entity tables
     *
     * @param string $baseTableName base table name
     * @param array  $options       additional option
     * @return \Oggetto_Blog_Model_Resource_Setup
     * @throws Mage_Eav_Exception
     */
    public function createEntityTables($baseTableName, array $options = array())
    {
        $connection = $this->getConnection();
        $types = array(
            'datetime'  => array(Varien_Db_Ddl_Table::TYPE_DATETIME, null),
            'decimal'   => array(Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4'),
            'int'       => array(Varien_Db_Ddl_Table::TYPE_INTEGER, null),
            'text'      => array(Varien_Db_Ddl_Table::TYPE_TEXT, '64k'),
            'varchar'   => array(Varien_Db_Ddl_Table::TYPE_TEXT, '255'),
        );
        $tables = array();

        $mainTable = $connection->newTable($baseTableName)
            ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'identity'  => true,
                'nullable'  => false,
                'primary'   => true,
                'unsigned'  => true,
            ), 'Entity Id')
            ->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                'unsigned'  => true,
                'nullable'  => false,
                'default'   => '0',
            ), 'Entity Type Id')
            ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                'unsigned'  => true,
                'nullable'  => false,
                'default'   => '0',
            ), 'Store Id')
            ->addColumn('url_key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
                'nullable'  => false,
            ), 'Url Key')
            ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
                'nullable'  => false,
            ), 'Created At')
            ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
                'nullable'  => false,
            ), 'Updated At')
            ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                'unsigned'  => true,
                'nullable'  => false,
                'default'   => '1',
            ), 'Defines Is Entity Active')

            ->addIndex($this->getIdxName($baseTableName, array('entity_type_id')), array('entity_type_id'))
            ->addIndex($this->getIdxName($baseTableName, array('store_id')), array('store_id'))
            ->addIndex($this->getIdxName($baseTableName, array('url_key')), array('url_key'))

            ->addForeignKey(
                $this->getFkName($baseTableName, 'entity_type_id', 'eav/entity_type', 'entity_type_id'),
                'entity_type_id', $this->getTable('eav/entity_type'), 'entity_type_id',
                Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
            ->addForeignKey(
                $this->getFkName($baseTableName, 'store_id', 'core/store', 'store_id'),
                'store_id', $this->getTable('core/store'), 'store_id',
                Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
            ;
        $tables[$this->getTable($baseTableName)] = $mainTable;

        foreach ($types as $type => $fieldType) {
            $eavTableName = array($baseTableName, $type);

            $eavTable = $connection
                ->newTable($this->getTable($eavTableName))
                ->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                    'identity'  => true,
                    'nullable'  => false,
                    'primary'   => true,
                    ), 'Value Id')
                ->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                    'unsigned'  => true,
                    'nullable'  => false,
                    'default'   => '0',
                    ), 'Entity Type Id')
                ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                    'unsigned'  => true,
                    'nullable'  => false,
                    'default'   => '0',
                    ), 'Attribute Id')
                ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                    'unsigned'  => true,
                    'nullable'  => false,
                    'default'   => '0',
                    ), 'Store Id')
                ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                    'unsigned'  => true,
                    'nullable'  => false,
                    ), 'Entity Id')
                ->addColumn('value', $fieldType[0], $fieldType[1], array(
                    'nullable'  => false,
                    ), 'Attribute Value')

                ->addIndex($this->getIdxName($eavTableName, array('entity_type_id')),array('entity_type_id'))
                ->addIndex($this->getIdxName($eavTableName, array('attribute_id')),array('attribute_id'))
                ->addIndex($this->getIdxName($eavTableName, array('store_id')),array('store_id'))
                ->addIndex($this->getIdxName($eavTableName, array('entity_id')),array('entity_id'))

                ->addForeignKey($this->getFkName($eavTableName, 'entity_id', $baseTableName, 'entity_id'),
                    'entity_id', $this->getTable($baseTableName), 'entity_id',
                    Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)

                ->addForeignKey($this->getFkName($eavTableName, 'entity_type_id', 'eav/entity_type', 'entity_type_id'),
                    'entity_type_id', $this->getTable('eav/entity_type'), 'entity_type_id',
                    Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)

                ->addForeignKey($this->getFkName($eavTableName, 'store_id', 'core/store', 'store_id'),
                    'store_id', $this->getTable('core/store'), 'store_id',
                    Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)

                ->setComment('Eav Entity Value Table');

            $tables[$this->getTable($eavTableName)] = $eavTable;
        }

        $connection->beginTransaction();
        try {
            foreach ($tables as $tableName => $table) {
                $connection->createTable($table);
            }
            $connection->commit();
        } catch (Exception $e) {
            $connection->rollBack();
            Mage::logException($e);
            throw Mage::exception('Mage_Eav', Mage::helper('eav')->__('Can\'t create table: %s', $tableName));
        }

        return $this;
    }
}