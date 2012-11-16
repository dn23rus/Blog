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
 * General tab form
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Block
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Block_Adminhtml_Blog_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Prepare form before rendering HTML
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form;
        $this->setForm($form);

        $fieldset = $form->addFieldset('post_form', array(
            'legend' => Mage::helper('oggetto_blog')->__('Post Information')
        ));

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('oggetto_blog')->__('Title'),
            'required'  => true,
            'class'     => 'required-entry',
        ));

        $fieldset->addField('url_key', 'text', array(
            'name'      => 'url_key',
            'label'     => Mage::helper('oggetto_blog')->__('URL Key'),
            'required'  => false,
            'note'      => Mage::helper('oggetto_blog')
                ->__('Leave empty for automatic generation (only latin characters)'),
        ));

        $fieldset->addField('shor_desciption', 'textarea', array(
            'name'      => 'short_description',
            'label'     => Mage::helper('oggetto_blog')->__('Short Description'),
            'required'  => false,
        ));

        $fieldset->addField('content', 'textarea', array(
            'name'      => 'content',
            'label'     => Mage::helper('oggetto_blog')->__('Content'),
            'required'  => true,
        ));

        $fieldset->addField('author', 'text', array(
            'name'      => 'author',
            'label'     => Mage::helper('oggetto_blog')->__('Author'),
            'required'  => false,
        ));

        $post = Mage::registry(Oggetto_Blog_Model_Post::REGISTRY_KEY);
        if ($post) {
            $form->setValues($post->getData());
        }

        return parent::_prepareForm();
    }
}