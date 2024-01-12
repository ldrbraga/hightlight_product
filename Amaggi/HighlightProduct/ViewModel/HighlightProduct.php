<?php
declare(strict_types=1);

namespace Amaggi\HighlightProduct\ViewModel;

use Amaggi\HighlightProduct\Model\Data\Config;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Helper\Image as ImageHelper;

class HighlightProduct implements ArgumentInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var ImageHelper $imageHelper
     */
    private $imageHelper;

    /**
     * @var Config
     */
    private $config;

    private $stockItemRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param Config $config
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ImageHelper $imageHelper,
        Config $config,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,

    ){
        $this->productRepository = $productRepository;
        $this->imageHelper = $imageHelper;
        $this->config = $config;
        $this->stockItemRepository = $stockItemRepository;
    }

    /**
     * @return string
     */
    public function getProduct()
    {
        $sku = $this->config->getHighlightProductSku();

        try {
            return $this->productRepository->get($sku);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getImage($product)
    {
        return $this->imageHelper->init($product, 'product_base_image')->getUrl();
    }

    public function getStockQty($product)
    {
        $productId = $product->getId();
        try {
            $productStock = $this->stockItemRepository->get($productId);
            return $productStock->getQty();
        } catch (\Exception $e) {}
        return null;
    }
}
