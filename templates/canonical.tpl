{* $Id: canonical.tpl 57813 2016-03-07 20:08:51Z jonnybradley $ *}
{if $prefs.feature_canonical_url eq 'y' and isset($mid)}
	{if $mid eq 'tiki-show_page.tpl' or $mid eq 'tiki-index_p.tpl' or $mid eq 'tiki-show_page_raw.tpl' or $mid eq 'tiki-all_languages.tpl' or $mid eq 'tiki-show_content.tpl'}
		<link rel="canonical" href="{$base_url_canonical}{$page|sefurl}{if not empty($canonical_ending)}{$canonical_ending}{/if}">
	{elseif $mid eq 'tiki-view_tracker_item.tpl'}
		<link rel="canonical" href="{$base_url_canonical}{$itemId|sefurl:trackeritem}">
	{elseif $mid eq 'tiki-view_forum.tpl'}
		<link rel="canonical" href="{$base_url_canonical}{$forumId|sefurl:forum}">
	{elseif $mid eq 'tiki-view_forum_thread.tpl'}
		<link rel="canonical" href="{$base_url_canonical}{$comments_parentId|sefurl:forumthread}">
	{elseif $mid eq 'tiki-view_blog.tpl'}
		<link rel="canonical" href="{$base_url_canonical}{$blogId|sefurl:blog}">
	{elseif $mid eq 'tiki-view_blog_post.tpl'}
		<link rel="canonical" href="{$base_url_canonical}{$postId|sefurl:blogpost}">
	{elseif $mid eq 'tiki-read_article.tpl'}
		<link rel="canonical" href="{$base_url_canonical}{$articleId|sefurl:article}">
	{elseif $mid eq 'tiki-browse_categories.tpl'}
		<link rel="canonical" href="{$base_url_canonical}{$parentId|sefurl:category}">
	{/if}
{/if}
