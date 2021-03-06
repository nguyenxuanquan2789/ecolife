{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
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
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{block name='cart_detailed_product'}
  <div class="cart-overview js-cart" data-refresh-url="{url entity='cart' params=['ajax' => true, 'action' => 'refresh']}">
    {if $cart.products}
    <ul class="cart-items">
      <div class="cart-items-title">
		  <div class="row">
			<!--  product left content: image-->
			<div class="product-line-grid-left col-md-5 col-xs-6">
			  {l s='Item' d='Shop.Theme.Checkout'}
			</div>
			<!--  product left body: description -->
			<div class="product-line-grid-right product-line-actions col-md-7 col-xs-6">
			  <div class="row">
				<div class="col-md-4">{l s='Price' d='Shop.Theme.Checkout'}</div>
				<div class="col-md-3">{l s='Qty' d='Shop.Theme.Checkout'}</div>
				<div class="col-md-4">{l s='Total price' d='Shop.Theme.Checkout'}</div>
				<div class="col-md-1"><i class="fa fa-trash-o invisible" aria-hidden="true"></i></div>
			  </div>
			</div>
		  </div>
      </div>
      {foreach from=$cart.products item=product}
        <li class="cart-item">
          {block name='cart_detailed_product_line'}
            {include file='checkout/_partials/cart-detailed-product-line.tpl' product=$product}
          {/block}
        </li>
        {if is_array($product.customizations) && $product.customizations|count >1}<hr>{/if}
      {/foreach}
    </ul>
    {else}
      <span class="no-items">{l s='There are no more items in your cart' d='Shop.Theme.Checkout'}</span>
    {/if}
  </div>
{/block}
