{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}

{extends file='page.tpl'}
{block name='page_title'}
<header class="page-header">
  <h1>{l s='Wishlist' mod='poswishlist'}</h1>
</header>
{/block}

{block name='breadcrumb'}
  <div class="breadcrumb_container ">
	  <div class="container">
		  <div class="breadcrumb">
			<ol itemscope itemtype="http://schema.org/BreadcrumbList">
				{foreach from=$breadcrumb.links item=path name=breadcrumb}
			  {block name='breadcrumb_item'}
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="{$path.url}">
				  <span itemprop="name">{$path.title}</span>
				</a>
				<meta itemprop="position" content="{$smarty.foreach.breadcrumb.iteration}">
				</li>
			  {/block}
			  {/foreach}
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<span itemprop="name">{l s='Wishlist' mod='poswishlist'}</span>
				  <meta itemprop="position" content="2">
				</li>
			</ol>
		  </div>
	  </div>
  </div>
{/block}

{block name='page_content_container'}
    <section id="content" class="page-content page-wishlist">
        <div id="view_wishlist">
           <div class="wlp_bought">
				<div class="row wlp_bought_list">
				{foreach from=$products item=product name=i}
					<div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="wlp_product" id="wlp_{$product.id_product}_{$product.id_product_attribute}">
						<a href="#" class="lnkdel" onclick="deleteProductWishlist('{$product.id_product}', '{$product.id_product_attribute}'); return false;" title="{l s='Delete' mod='poswishlist'}"><i class="material-icons close">close</i>
						</a>
					  <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemprop="item" itemscope itemtype="http://schema.org/Product">
								    <div class="img_block">
								      {block name='product_thumbnail'}
								        {if $product.cover}
								          <a href="{$product.url}" class="thumbnail product-thumbnail">
								            <img
								              src="{$product.cover.bySize.home_default.url}"
								              alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
								              data-full-size-image-url="{$product.cover.large.url}"
								              />
								          </a>
								        {else}
								          <a href="{$product.url}" class="thumbnail product-thumbnail">
								            <img src="{$urls.no_picture_image.bySize.home_default.url}" />
								          </a>
								        {/if}
								      {/block}

								      <div class="product_desc">
								        {block name='product_name'}
								            <h3 itemprop="name"><a href="{$product.url}" itemprop="url" content="{$product.url}" class="product_name">{$product.name|truncate:30:'...'}</a></h3>
								        {/block}
										<div class="hook-reviews">	
								        {block name='product_reviews'}
								          {hook h='displayProductListReviews' product=$product}
								        {/block}
										</div>
								        {block name='product_price_and_shipping'}
										  {if $product.show_price}
											<div class="product-price-and-shipping">
											  {if $product.has_discount}
												{hook h='displayProductPriceBlock' product=$product type="old_price"}
												<span class="regular-price" aria-label="{l s='Regular price' d='Shop.Theme.Catalog'}">{$product.regular_price}</span>
											  {/if}

											  {hook h='displayProductPriceBlock' product=$product type="before_price"}

											  <span class="price {if $product.has_discount}price-sale{/if}" aria-label="{l s='Price' d='Shop.Theme.Catalog'}">
												{capture name='custom_price'}{hook h='displayProductPriceBlock' product=$product type='custom_price' hook_origin='products_list'}{/capture}
												{if '' !== $smarty.capture.custom_price}
												  {$smarty.capture.custom_price nofilter}
												{else}
												  {$product.price}
												{/if}
											  </span>
												
											  {hook h='displayProductPriceBlock' product=$product type='unit_price'}

											  {hook h='displayProductPriceBlock' product=$product type='weight'}
											  {if $product.has_discount}
												{if $product.discount_type === 'percentage'}
												  <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
												{elseif $product.discount_type === 'amount'}
												  <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
												{/if}
											  {/if}
											</div>
										  {/if}
										{/block}
										{if (isset($product.attribute_quantity) && $product.attribute_quantity >= 1) || (!isset($product.attribute_quantity) && $product.product_quantity >= 1) || $product.allow_oosp}
                                            <form action="{$link->getPageLink('cart')|escape:'html'}" method="post">
                                                <input type="hidden" name="token" value="{$static_token}">
                                                <input type="hidden" name="id_product" value="{$product.id_product}">
                                                <input type="hidden" name="id_product_attribute" value="{$product.id_product_attribute}">
                                                <input type="hidden" name="qty" value="{$product.minimal_quantity}">
                                                <a class="btn-secondary add-to-cart show_popup has-text align-self-center" href="#" data-button-action="add-to-cart"><span>{l s='Add to cart' mod='poswishlist'}</span></a>
                                            </form>
                                        {/if}
								      </div>
								    </div>
								  </article>
					</div>
				{/foreach}
				</div>
			</div>
        </div>
    </section>
{/block}
{block name="page_footer_container"}
{/block}