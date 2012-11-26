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
 * Main
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Test
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{

    /**
     * Test module version
     *
     * @return void
     */
    public function testModuleVersion()
    {
        $this->assertModuleVersion('0.1.1');
    }

    /**
     * Test resouce setup
     *
     * @return void
     */
    public function testResourceSetup()
    {
        $this->assertSetupResourceDefined();
        $this->assertSetupResourceExists();
        $this->assertSetupScriptVersions();
    }

    /**
     * Test tables aliases
     *
     * @return void
     */
    public function testTableAliase()
    {
        $this->assertTableAlias('oggetto_blog/post', 'oggetto_blog_post_entity');
        $this->assertTableAlias('oggetto_blog/post_index', 'oggetto_blog_post_index');
    }

    /**
     * Test class aliases
     *
     * @return void
     */
    public function testClassAlias()
    {
        $this->assertModelAlias('oggetto_blog/post', 'Oggetto_Blog_Model_Post');
        $this->assertResourceModelAlias('oggetto_blog/post', 'Oggetto_Blog_Model_Resource_Post');
        $this->assertModelAlias('oggetto_blog/attribute_source_status', 'Oggetto_Blog_Model_Attribute_Source_Status');
    }
}