<{include file="db:wgsitenotice_header.tpl"}>
<table class="wgsitenotice outer">
	<tbody>
		<{foreach item=list from=$contents}>	
			<tr class="<{cycle values='odd, even'}>">
				<th class="center"><{$list.header}></th>
			</tr>
			<tr class="<{cycle values='odd, even'}>">
				<td class="center"><{$list.text}></td>
			</tr>
        <{/foreach}>
	</tbody>
</table>
<{include file="db:wgsitenotice_footer.tpl"}>