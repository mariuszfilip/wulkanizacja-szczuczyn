<html>
<body>
<font style="font: 11px Verdana, Tahoma;">

<b>Ordered service:</b> {$service.name}<br><br>
<b>Price:</b> {$service.price} $<br><br>
{$service.short_content}<br><br>
<b>Prepayment:</b> {$order.price} $<br><br>
<hr><br>
<b>Your data</b><br><br>
<b>Name & Surmane:</b> {$order.name}<br><br>
<b>Address:</b> {$order.address}<br><br>
<b>Phone:</b> {$order.phone}<br><br>
<b>Email:</b> {$order.email}<br><br>
{if $order.comment}<b>Your comments:</b> {$order.comment|nl2br}<br><br>{/if}
<hr><br>
{$order.message|nl2br}<br><br>
</font>

<p style="text-align:center; width:100%; font-weight:bold; font: 12px Verdana, Tahoma;">
<b>To make a payment for this service please click on the link below:</b><br>
<a href="{$smarty.const.SITE_ADDRESS}paypal.php?code={$code}" style="font: 11px Verdana, Tahoma; color:#F00; font-weight:bold;">{$smarty.const.SITE_ADDRESS}paypal.php?code={$code}</a>
</p>
</body>
</html>