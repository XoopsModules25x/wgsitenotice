<{if $bookmarks != 0}>
<{include file="db:system_bookmarks.html"}>
<{/if}>

<{if $fbcomments != 0}>
<{include file="db:system_fbcomments.html"}>
<{/if}>
<div class="left"><{$copyright}></div>
<{if $pagenav != ''}>
	<div class="right"><{$pagenav}></div>
<{/if}>
<br />
<{if $xoops_isadmin}>
   <div class="center bold"><a href="<{$admin}>"><{$smarty.const._MA_WGSITENOTICE_ADMIN}></a></div><br />
<{/if}>
