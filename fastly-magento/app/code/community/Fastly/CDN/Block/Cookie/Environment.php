<?php
/**
 * Fastly CDN for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Fastly CDN for Magento End User License Agreement
 * that is bundled with this package in the file LICENSE_FASTLY_CDN.txt.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Fastly CDN to newer
 * versions in the future. If you wish to customize this module for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Fastly
 * @package     Fastly_CDN
 * @copyright   Copyright (c) 2015 Fastly, Inc. (http://www.fastly.com)
 * @license     BSD, see LICENSE_FASTLY_CDN.txt
 */

class Fastly_CDN_Block_Cookie_Environment extends Mage_Core_Block_Template
{
    /**
     * @var Fastly_CDN_Helper_Environment
     */
    protected $_helper;


    protected function _construct()
    {
        // set default cache lifetime and cache tags
        $this->addData(array(
                            'cache_lifetime'    => false,
                            'cache_tags'        => array(Mage_Core_Model_Store::CACHE_TAG),
                       ));
    }

    /**
     * @return Fastly_CDN_Helper_Environment
     */
    protected function _getHelper()
    {
        if (is_null($this->_helper)) {
            $this->_helper = Mage::helper('fastlycdn/environment');
        }
        return $this->_helper;
    }

    /**
     * Get key pieces for caching block content
     *
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $cacheId = array(
            'FASTLYCDN_COOKIE_ENVIRONMENT_',
            Mage::app()->getStore()->getId(),
            Mage::getDesign()->getPackageName(),
            Mage::getDesign()->getTheme('template'),
            Mage::getSingleton('customer/session')->getCustomerGroupId(),
            Mage::app()->getStore()->getCurrentCurrencyCode(),
            'template' => $this->getTemplate(),
            'name' => $this->getNameInLayout(),
        );
        return $cacheId;
    }

    /**
     * Return value for environment cookie if current env differs from default
     *
     * @return string
     */
    public function getEnvironmentHash()
    {
        return $this->_getHelper()->getEnvironmentHash();
    }

    /**
     * Return cookie lifetime for environment cookie
     *
     * @return int
     */
    public function getCookieLifetime()
    {
        return $this->_getHelper()->getCookieLiftime();
    }

    /**
     * Return environment cookie name
     *
     * @return string
     */
    public function getCookieName()
    {
        return $this->_getHelper()->getCookieName();
    }
}