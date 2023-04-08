<ul class="breadcrumb">
    <li><a href="<{xoAppUrl 'index.php'|default:''}>" title="home"><i class="glyphicon glyphicon-home fa fa-home"></i></a></li>
    <{foreach item=itm from=$xoBreadcrumbs name=bcloop}>
        <{if $itm.link|default:false}>
            <li><a href="<{$itm.link}>" title="<{$itm.title|default:''}>"><{$itm.title|default:''}></a></li>
        <{else}>
            <li><{$itm.title|default:''}></li>
        <{/if}>
    <{/foreach}>
</ul>