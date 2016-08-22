<table class="versions width100">
	<tbody>
		<{foreach item=list from=$block}>	
			<tr class="<{cycle values='odd, even'}>">
				<td class="left">
                    <a href="<{$smarty.const.WGSITENOTICE_URL}>/index.php?version_id=<{$list.version_id}>" title="<{$list.version_name}>"><{$list.version_name}></a>                
                </td>
			</tr>
		<{/foreach}>
        <{if $list.show_more}>
            <tr class="<{cycle values='odd, even'}>">
				<td class="center">
                    <br/><a href="<{$smarty.const.WGSITENOTICE_URL}>/index.php" title="<{$smarty.const._MB_WGSITENOTICE_SHOW_MORE}>"><{$smarty.const._MB_WGSITENOTICE_SHOW_MORE}></a>                
                </td>
            </tr>
        <{/if}>
    </tbody>
</table>