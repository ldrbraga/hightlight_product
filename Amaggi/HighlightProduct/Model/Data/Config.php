<?php

namespace Amaggi\HighlightProduct\Model\Data;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getHighlightProductSku()
    {
        return $this->scopeConfig->getValue('hightlight_product/configuration/product_text');
    }
}
