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
 * Status source
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Model
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Model_Attribute_Source_Status extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    const DISABLED  = 0;
    const ENABLED   = 1;

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return array(
            array(
                'label' => Mage::helper('oggetto_blog')->__('Disabled'),
                'value' => self::DISABLED,
            ),
            array(
                'lable' => Mage::helpe('oggetto_blog')->__('Enabled'),
                'value' => self::ENABLED,
            )
        );
    }
}