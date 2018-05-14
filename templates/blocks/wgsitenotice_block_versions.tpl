<ul class="nav nav-pills nav-stacked">
    <{foreach item=list from=$block}>
        <li class="<{if $list.highlight}>active<{/if}>">
            <a href="<{$smarty.const.WGSITENOTICE_URL}>/index.php?version_id=<{$list.version_id}>" title="<{$list.version_name}>">
                <{$list.version_name}>
            </a>
        </li>
    <{/foreach}>
</ul>

<{if $list.show_more}>
    <div class="center">
        <a class="btn btn-success" href="<{$smarty.const.WGSITENOTICE_URL}>/index.php" title="<{$smarty.const._MB_WGSITENOTICE_SHOW_MORE}>"><{$smarty.const._MB_WGSITENOTICE_SHOW_MORE}></a>                
    </div>
<{/if}>