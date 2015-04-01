<div style="width: {$smarty.get.width}px; height: auto; overflow: auto;">
	{foreach from=$photos item=photo}
		<img src="../thumb.php?dir=files/photo/&amp;file={$photo.file_name|escape:url}&amp;w=150&amp;h=150" />
	{/foreach}
</div>