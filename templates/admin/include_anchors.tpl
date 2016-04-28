{*$Id: include_anchors.tpl 57408 2016-02-02 13:29:34Z jonnybradley $*}
{foreach from=$admin_icons key=page item=info}
	{if ! $info.disabled}
		<li><a href="tiki-admin.php?page={$page}" alt="{$info.title} {$info.description}" class="tips icon text-muted" title="{$info.title}|{$info.description}">
			{icon name="admin_$page"}
		</a></li>
	{/if}
{/foreach}