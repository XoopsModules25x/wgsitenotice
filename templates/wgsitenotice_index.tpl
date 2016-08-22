<{include file="db:wgsitenotice_header.tpl"}>
<{foreach item=list from=$contents}>	
    <h3 style="text-align:center;align:center"><{$list.header}></h3>
    <span style="text-align:left;align:left"><{$list.text}></span>
<{/foreach}>
<{include file="db:wgsitenotice_footer.tpl"}>