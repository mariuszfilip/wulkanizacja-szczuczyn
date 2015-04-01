<html>
<body>
<table width="90%" border="0" style="border-collapse:collapse; font:12px Tahoma, Geneva, sans-serif; color:#3b3b3b; width:90%; margin:0 auto 20px auto;">
  <tr valign="top">
    <td style="color:#123969; padding:4px 0; width:22%; border-bottom:1px solid #f0f0f0;"><b>Ordered service:</b></td>
    <td style="padding:4px 0; font-weight:bold; border-bottom:1px solid #f0f0f0;">{$service.name}</td>
  </tr>
  
  <tr valign="top">
	  <td style="padding:4px 0;  width:22%; border-bottom:1px solid #f0f0f0;">&nbsp;</td>
    <td style="padding:4px 0; border-bottom:1px solid #f0f0f0;">{$service.short_content}</td>
  </tr>
  
  <tr valign="top">
    <td style="color:#123969; padding:4px 0;  width:22%; border-bottom:1px solid #f0f0f0;"><b>Price:</b></td>
    <td style="color:#d00000; font-weight:bold; padding:4px 0; border-bottom:1px solid #f0f0f0;">{$service.price} $</td>
  </tr>
</table>

<table width="90%" border="0" style="border-collapse:collapse; font:12px Tahoma, Geneva, sans-serif; color:#3b3b3b; width:90%; margin:0 auto 20px auto;">
  <tr valign="top">
    <td colspan="2" style="padding:4px 0; border-bottom:1px solid #f0f0f0;"><b>Your data:</b></td>
  </tr>
  
  <tr valign="top">
    <td style="color:#0774a8; padding:4px 0;  width:22%; border-bottom:1px solid #f0f0f0;"><b>Name & Surmane:</b></td>
    <td style="padding:4px 0; border-bottom:1px solid #f0f0f0;">{$order.name}</td>
  </tr>
  
  <tr valign="top">
    <td style="color:#0774a8; padding:4px 0;  width:22%; border-bottom:1px solid #f0f0f0;"><b>Address:</b></td>
    <td style="padding:4px 0; border-bottom:1px solid #f0f0f0;">{$order.address}</td>
  </tr>
  
  <tr valign="top">
    <td style="color:#0774a8; padding:4px 0;  width:22%; border-bottom:1px solid #f0f0f0;"><b>Email:</b></td>
    <td style="padding:4px 0; border-bottom:1px solid #f0f0f0;">{$order.email}</td>
  </tr>
  
  <tr valign="top">
    <td style="color:#0774a8; padding:4px 0;  width:22%; border-bottom:1px solid #f0f0f0;"><b>Phone:</b></td>
    <td style="padding:4px 0; border-bottom:1px solid #f0f0f0;">{$order.phone}</td>
  </tr>
  
	{if $order.comment}  
  <tr valign="top">
    <td style="color:#0774a8; padding:4px 0;  width:22%; border-bottom:1px solid #f0f0f0;"><b>Your comments:</b></td>
    <td style="padding:4px 0; border-bottom:1px solid #f0f0f0;">{$order.comment|nl2br}</td>
  </tr>
  {/if}
  
</table>
</body>
</html>
