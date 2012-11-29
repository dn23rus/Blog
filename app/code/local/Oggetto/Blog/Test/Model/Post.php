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
 * Post
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Test
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Test_Model_Post extends EcomDev_PHPUnit_Test_Case
{

    protected $_model;

    /**
     * Setup data
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->_model = Mage::getModel('oggetto_blog/post');
    }

    /**
     * Unset data
     *
     * @return void
     */
    public function teadDown()
    {
        parent::tearDown();
        unset($this->_model);
    }

    /**
     * Test loading by url key
     *
     * @dataProvider dataProvider
     * @return void
     */
    public function testLoadByUrlKey($key)
    {
        $id = $this->expected('test1')->getId();
        $this->_model->loadByUrlKey($key);
        $this->assertSame($this->_model->getId(), $id);
    }
}