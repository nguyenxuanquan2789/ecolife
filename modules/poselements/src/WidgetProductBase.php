<?php
/**
 * Posthemes Widgets
 *
 * @package   Posthemes
 * @version   1.0.0
 * @copyright Copyright Ⓒ Since 2011 Posthemes < @email:posthemes@gmail.com >
 * @license   You only can use the module, nothing more!
 */

namespace Posthemes\Module\Poselements;

use Db;
use Tools;
use Module;
use Context;
use Product;
use Configuration;
use Pkthemesettings;
use CrazyElements\Widget_Base;
use CrazyElements\PrestaHelper;
use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\BestSales\BestSalesProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class WidgetProductBase extends Module
{
    public $orderBy;
    public $orderWay;

    public function __construct()
    {
        $this->orderBy = Tools::getProductsOrder('by', Tools::getValue('orderby'));
        $this->orderWay = Tools::getProductsOrder('way', Tools::getValue('orderway'));
    }

    public function getProductsIDs($listing, $limit)
    {
        $list = $this->getProducts($listing, $limit);

        $ids = [];

        if (!empty($list))
        {
            foreach ($list as $product)
            {
                if (isset($product['id_product'])) {
                    $ids[] = $product['id_product'];
                } elseif (isset($product['id'])) {
                    $ids[] = $product['id'];
                }
            }
        }
        return $ids;
    }

    public function getProducts($listing, $limit = 0, $id_category = 2, $products = [])
    {
        $tpls = [];
        $searchProvider = false;
        $this->context = Context::getContext();

        if ('handpicked' === $listing)
        {
            foreach ($products as $id)
            {
                if (is_array($id) && isset($id['id']))
                {
                    $id = $id['id'];
                }
                if (is_numeric($id))
                {
                    $tpls[] = $this->getProduct((int)$id);
                }
            }
            return $tpls;
        }

        $query = new ProductSearchQuery();
        $query->setResultsPerPage($limit <= 0 ? 8 : (int) $limit);
        $query->setQueryType($listing);

        switch ($listing)
        {
            case 'category':
                $category = new \Category((int) $id_category);
                $searchProvider = new CategoryProductSearchProvider($this->context->getTranslator(), $category);
                $query->setQueryType($listing);
                $query->setSortOrder(
                    'rand' == $this->orderBy
                    ? SortOrder::random()
                    : new SortOrder('product', $this->orderBy, $this->orderWay)
                );
                break;
            case 'featured':
                $category = new \Category((int)Configuration::get('HOME_FEATURED_CAT'));
                $searchProvider = new CategoryProductSearchProvider($this->context->getTranslator(), $category);
                $query->setQueryType($listing);
                $query->setSortOrder(new SortOrder('product', 'date_add', 'desc'));
                break;
            case 'prices-drop':
                $searchProvider = new \PrestaShop\PrestaShop\Adapter\PricesDrop\PricesDropProductSearchProvider($this->context->getTranslator());
                $query->setQueryType($listing);
                $query->setSortOrder(new SortOrder('product', $this->orderBy, $this->orderWay));
                break;
            case 'new-products':
                $searchProvider = new \PrestaShop\PrestaShop\Adapter\NewProducts\NewProductsProductSearchProvider($this->context->getTranslator());
                $query->setSortOrder(new SortOrder('product', 'date_add', 'desc'));
                break;
            case 'best-sales':
                $searchProvider = new \PrestaShop\PrestaShop\Adapter\BestSales\BestSalesProductSearchProvider($this->context->getTranslator());
                $query->setSortOrder(new SortOrder('product', 'name', 'asc'));
                break;
        }

        if (!$searchProvider)
        {
            return $tpls;
        }

        $result = $searchProvider->runQuery(new ProductSearchContext($this->context), $query);

        $assembler = new \ProductAssembler($this->context);
        $presenterFactory = new \ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new ProductListingPresenter(
            new ImageRetriever($this->context->link),
            $this->context->link,
            new PriceFormatter(),
            new ProductColorsRetriever(),
            $this->context->getTranslator()
        );

        foreach ($result->getProducts() as $rawProduct)
        {
            $tpls[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $this->context->language
            );
        }
        return $tpls;
    }

    public function getProduct($id)
    {
        if (!isset($this->context)) {
            $this->context = Context::getContext();
            $this->context->customer = new \stdClass();
            $this->context->customer->id = null;
        }
        
        $presenter = new ProductListingPresenter(
            new ImageRetriever($this->context->link),
            $this->context->link,
            new PriceFormatter(),
            new ProductColorsRetriever(),
            $this->context->getTranslator()
        );
        $presenterFactory = new \ProductPresenterFactory($this->context);
        $assembler = new \ProductAssembler($this->context);
        $result = ['id_product' => $id];

        try {
            if (!$assembledProduct = $assembler->assembleProduct($result)) {
                return false;
            }
            return $presenter->present(
                $presenterFactory->getPresentationSettings(),
                $assembledProduct,
                $this->context->language
            );
        } catch (\Exception $ex) {
            return false;
        }
    }

    public function getTabsData(array $params)
    {
        $tabs = [];
        $productBase = new WidgetProductBase;

        if (!is_array($params['multi_types']))
        {
            $params['multi_types'] = [];
        }

        if (in_array('featured', $params['multi_types']))
        {
            $items = $productBase->getProducts('featured', $params['tabs_number']);
            $tabs['featured'] = [
                'products' => $items,
                'title' => WidgetHelper::getTrans()->trans('Featured', [], 'Modules.Pkelements.Pkproducts'),
                'is_tab_carousel' => WidgetHelper::isTabCarousel($params, count($items))
            ];
        }

        if (in_array('special', $params['multi_types']))
        {
            $items = $productBase->getProducts('prices-drop', $params['tabs_number']);
            $tabs['special'] = [
                'products' => $items,
                'title' => WidgetHelper::getTrans()->trans('Special', [], 'Modules.Pkelements.Pkproducts'),
                'is_tab_carousel' => WidgetHelper::isTabCarousel($params, count($items))
            ];
        }

        if (in_array('new', $params['multi_types']))
        {
            $items = $productBase->getProducts('new-products', $params['tabs_number']);
            $tabs['new'] = [
                'products' => $items,
                'title' => WidgetHelper::getTrans()->trans('New', [], 'Modules.Pkelements.Pkproducts'),
                'is_tab_carousel' => WidgetHelper::isTabCarousel($params, count($items))
            ];
        }

        if (in_array('bestsellers', $params['multi_types']))
        {
            $items = $productBase->getProducts('best-sales', $params['tabs_number']);
            $tabs['bestsellers'] = [
                'products' => $items,
                'title' => WidgetHelper::getTrans()->trans('Bestsellers', [], 'Modules.Pkelements.Pkproducts'),
                'is_tab_carousel' => WidgetHelper::isTabCarousel($params, count($items))
            ];
        }

        if (!empty($params['multi_categories']))
        {
            foreach ($params['multi_categories'] as $id)
            {
                $items = $productBase->getProducts('category', $params['tabs_number'], $id);
                $cat = \Category::getCategoryInformations([$id], \Context::getContext()->language->id);

                if (!isset($cat[$id]['link_rewrite'])) {
                    continue;
                }
                
                $tabs[$cat[$id]['link_rewrite']] = [
                    'products' => $items,
                    'title' => $cat[$id]['name'],
                    'is_tab_carousel' => WidgetHelper::isTabCarousel($params, count($items))
                ];
            }
        }

        return ['tabs' => $tabs];
    }

    public function getIsotopeData(array $params)
    {
        $productBase = new WidgetProductBase;
        $products = $products_ids = $tabs = [];

        $tabs['all'] = [
            'id' => 'all',
            'title' => WidgetHelper::getTrans()->trans('All', [], 'Modules.Pkelements.Pkproducts'),
        ];

        if (!is_array($params['multi_types']))
        {
            $params['multi_types'] = [];
        }

        if (in_array('featured', $params['multi_types']))
        {
            $products_ids['featured'] = $productBase->getProductsIDs('featured', $params['isotope_number']);
            $tabs['featured'] = [
                'id' => '.featured',
                'title' => WidgetHelper::getTrans()->trans('Featured', [], 'Modules.Pkelements.Pkproducts'),
            ];
        }

        if (in_array('special', $params['multi_types']))
        {
            $products_ids['special'] = $productBase->getProductsIDs('prices-drop', $params['isotope_number']);
            $tabs['special'] = [
                'id' => '.discount',
                'title' => WidgetHelper::getTrans()->trans('Special', [], 'Modules.Pkelements.Pkproducts'),
            ];
        }

        if (in_array('new', $params['multi_types']))
        {
            $products_ids['new'] = $productBase->getProductsIDs('new-products', $params['isotope_number']);
            $tabs['new'] = [
                'id' => '.new',
                'title' => WidgetHelper::getTrans()->trans('New', [], 'Modules.Pkelements.Pkproducts'),
            ];
        }

        if (in_array('bestsellers', $params['multi_types']))
        {
            $products_ids['bestsellers'] = $productBase->getProductsIDs('best-sales', $params['isotope_number']);
            $tabs['bestsellers'] = [
                'id' => '.bestsellers',
                'title' => WidgetHelper::getTrans()->trans('Bestsellers', [], 'Modules.Pkelements.Pkproducts'),
            ];
        }

        if (!empty($params['multi_categories']))
        {
            foreach ($params['multi_categories'] as $id)
            {
                $products_ids['categories'][$id] = $productBase->getProductsIDs('category', $params['isotope_number'], $id);
                $cat = \Category::getCategoryInformations([$id], \Context::getContext()->language->id);
                $tabs[$id] = [
                    'id' => '.'.$cat[$id]['link_rewrite'],
                    'title' => $cat[$id]['name']
                ];
            }
        }

        $merged = [];

        foreach ($products_ids as $key => $type)
        {
            if ($key == 'categories') {
                foreach ($type as $category) {
                    $merged = array_merge($merged, $category);
                }
            } else {
                $merged = array_merge($merged, $type);
            }
        }

        if ($params['isotope_unique'])
        {
            $merged = array_unique($merged);
        }

        $merged = array_slice($merged, 0, $params['isotope_max_number']);

        if ($params['isotope_shuffle'])
        {
            shuffle($merged);
        }
        
        foreach ($merged as $id)
        {
            $products[] = $this->assignTypes($productBase->getProduct($id), $products_ids);
        }

        return [
            'tabs' => $tabs,
            'products' => $products
        ];
    }

    public function assignTypes($product, array $products_ids)
    {
        if (isset($products_ids['featured']) && isset($product['id']) && in_array(@$product['id'], $products_ids['featured']))
        {
            $product['featured'] = 1;
        }

        if (isset($products_ids['new']) && isset($product['id']) && in_array(@$product['id'], $products_ids['new']))
        {
            $product['new'] = 1;
        }

        if (isset($products_ids['bestsellers']) && isset($product['id']) && in_array(@$product['id'], $products_ids['bestsellers']))
        {
            $product['bestseller'] = 1;
        }

        if (isset($products_ids['categories']) && !empty($products_ids['categories']))
        {
            $product = $this->getProductCategories($product);
        }
        return $product;
    }

    public function getProductCategories($product)
    {
        $allCats = \Product::getProductCategories($product['id_product']);
        $product['all_cats'] = '';

        if (!empty($allCats))
        {
            $cats = \Category::getCategoryInformation($allCats);
            $cats_str = '';
            $cats_list = [];
            if (!empty($cats))
            {
                foreach ($cats as $k => $cat)
                {
                    $cats_list[$k] = $cat['link_rewrite'];
                }
                if (!empty($cats_list))
                {
                    $cats_str = implode(' ', $cats_list);
                }
            }
            $product['all_cats'] = $cats_str;
        }
        return $product;
    }

    public function getFirstProductId()
    {
        $result = Db::getInstance()->executeS('SELECT `id_product` FROM `'._DB_PREFIX_.'product` LIMIT 1;');
        return $result[0]['id_product'];
    }

    public function getDemoProduct()
    {
        // just a demo product to display in the back office builder
        $product_id = $this->getFirstProductId();
        $product = $this->getProducts('handpicked', 0, 2, [$product_id]);
        if (isset($product[0]))
        {
            $product[0]['id_customization'] = 0;
            $product[0]['quantity_wanted'] = 1;
        }
        return isset($product[0]) ? $product[0] : [];
    }

    public function getPageOptions()
    {
        $pktheme = new Pkthemesettings;
        // just a demo data to display content in the back office builder
        return [
            'groups' => [],
            'category' => [],
            'priceDisplay' => 0,
            'packItems' => false,
            'static_token' => '',
            'displayPackPrice' => 0,
            'displayUnitPrice' => false,
            'productPriceWithoutReduction' => 0,
            'pktheme' => $pktheme->getConfig(),
        ];
    }

}