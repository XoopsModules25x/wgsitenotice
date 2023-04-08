<ul class="nav nav-pills nav-stacked">
    <{foreach item=list from=$block|default:''}>
        <li class="li-wgsitenotice <{if $list.highlight|default:''}>active<{/if}>">
            <a href="<{$smarty.const.WGSITENOTICE_URL}>/index.php?version_id=<{$list.version_id|default:''}>" title="<{$list.version_name|default:''}>">
                <{$list.version_name|default:''}>
            </a>
        </li>
    <{/foreach}>
</ul>

<{if $list.show_more|default:false}>
    <div class="center">
        <a class="btn-wgsitenotice btn btn-success" href="<{$smarty.const.WGSITENOTICE_URL}>/index.php" title="<{$smarty.const._MB_WGSITENOTICE_SHOW_MORE}>"><{$smarty.const._MB_WGSITENOTICE_SHOW_MORE}></a>                
    </div>
<{/if}>