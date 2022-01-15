<article class="post-item design-4">
  <div class="post-image">
    <a title="{$post.title}" href="{$post.url}">
      <div class="img-placeholder">
        <img
          class="img-loader lazy-load" 
          data-src="{$post.image.url}"
          src="{$post.image.url}" 
          alt="{$post.title}"
          title="{$post.title}" 
          width="{$post.image.width}"
          height="{$post.image.height}"
        >   
      </div>
    </a>
	<div class="post-inner">
		{foreach from=$post.categories item="category"}
		  <div class="post-category" >
			<a href="{$smartbloglink->getSmartBlogCategoryLink($category.id_category,$category.cat_link_rewrite)|escape:'htmlall':'UTF-8'}">{$category.cat_name}</a> 
		  </div>
		{/foreach}
		<a class="post-title" title="{$post.title}" href="{$post.url}">{$post.title}</a>
	</div> 
  </div>
  <div class="post-content">
	  <div class="read_more">
		 <a href="{$post.url}">{l s='Read more' mod='poselements'} <i class="icon-rt-android-arrow-dropright-circle"></i></a>  
	  </div>  
   </div>
</article>