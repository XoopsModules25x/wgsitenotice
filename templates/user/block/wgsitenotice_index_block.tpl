<{include file="db:wgsitenotice_header.tpl"}>
<div class="col-sm-12 col-md-12 xoops-side-blocks">
    <{foreach item=list from=$contents}>
        <aside>
            <h4 class="block-title"><{$list.header}></h4>
            <{$list.text}>
        </aside>
    <{/foreach}>
</div>
<{include file="db:wgsitenotice_footer.tpl"}>