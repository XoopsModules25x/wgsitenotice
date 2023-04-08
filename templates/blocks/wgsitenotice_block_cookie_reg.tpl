<{if $block.infotext|default:''}>
    <style>
    #container-cookies-reg { 
        <{$block.position|default:false}>
        background: <{$block.bg_from|default:''}>;
        background: -moz-linear-gradient(top, <{$block.bg_from|default:''}> 0%, <{$block.bg_to|default:''}> 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<{$block.bg_from|default:''}>), color-stop(100%,<{$block.bg_to|default:''}>));
        background: -webkit-linear-gradient(top, <{$block.bg_from|default:''}> 0%,<{$block.bg_to|default:''}> 100%);
        background: -o-linear-gradient(top, <{$block.bg_from|default:''}> 0%,<{$block.bg_to|default:''}> 100%);
        background: -ms-linear-gradient(top, <{$block.bg_from|default:''}> 0%,<{$block.bg_to|default:''}> 100%);
        background: linear-gradient(to bottom, <{$block.bg_from|default:''}> 0%,<{$block.bg_to|default:''}> 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<{$block.bg_from|default:''}>', endColorstr='<{$block.bg_to|default:''}>',GradientType=0 );
        opacity: <{$block.opacity|default:''}>;
        color:<{$block.color|default:''}>;
        min-height:<{$block.height|default:''}>px;
        line-height:20px;
        outline: 1px solid #7b92a9; 
        text-align:right; 
        border-top:1px solid #fff;
        z-index:10000; 
        width:100%; 
        font-size:14px;
    }
    @media (min-width: 768px) {
        #container-cookies-reg {
            line-height:<{$block.height|default:''}>px;
        }
    }
    #container-cookies-reg a {
        color:<{$block.color|default:''}>;
        text-decoration:none;
        padding:3px;
    }
    #container-cookies-reg a:hover {text-decoration:underline;}
    #container-cookies-reg div {padding:10px; padding-right:80px;}
    #container-cookies-reg-text {padding-right:10px;}
    #cookies-reg-closer {
       color: #777;
       font: 14px/100% arial, sans-serif;
       position: absolute;
       right: 60px;
       text-decoration: none;
       text-shadow: 0 1px 0 #fff;
       top: 30%;
       cursor:pointer;
       border-top:1px solid white; 
       border-left:1px solid white; 
       border-bottom:1px solid #7b92a9; 
       border-right:1px solid #7b92a9; 
       padding:4px;
       background: #ced6df; /* Old browsers */
       background: -moz-linear-gradient(top, #ced6df0%, #f2f6f9 100%); 
       background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ced6df), color-stop(100%,#f2f6f9)); 
       background: -webkit-linear-gradient(top, #ced6df0%,#f2f6f9 100%); 
       background: -o-linear-gradient(top, #ced6df0%,#f2f6f9 100%); 
       background: -ms-linear-gradient(top, #ced6df0%,#f2f6f9 100%); 
       background: linear-gradient(to bottom, #ced6df0%,#f2f6f9 100%); 
       filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ced6df', endColorstr='#f2f6f9',GradientType=0 ); 
     }
    #cookies-reg-closer:hover {border-bottom:1px solid white; border-right:1px solid white; border-top:1px solid #7b92a9; border-left:1px solid #7b92a9;}
    </style>

    <div id="container-cookies-reg">
        <div>
            <span id="container-cookies-reg-text"><{$block.infotext|default:''}> (
                <{if $block.dataprotect_id|default:''}>
                    <a href="<{xoAppUrl 'modules/wgsitenotice/index.php?version_id=$block.dataprotect_id'}>"><{$block.dataprotect_text|default:''}></a><{$block.seperator|default:''}>
                <{/if}>
                <{if $block.cookie_reg_id|default:''}>
                    <a href="<{xoAppUrl 'modules/wgsitenotice/index.php?version_id=$block.cookie_reg_id'}>"><{$block.cookie_reg_text|default:''}></a>
                <{/if}>
            )</span>
            <{if $block.prependToBody|default:''}>
                <span id="cookies-reg-closer" onclick="document.cookie = '<{$block.unique_id|default:''}>=1;path=/';jQuery('#container-cookies-reg').slideUp()">&#10006;</span>
            <{/if}>
        </div>
        
    </div>

    <script>  
        if (document.cookie.indexOf('<{$block.unique_id|default:''}>=1') != -1) {
            jQuery('#container-cookies-reg').hide();
        } else {
            <{if $block.prependToBody|default:''}>
            jQuery('#container-cookies-reg').prependTo('body');
            <{/if}>
            jQuery('#cookies-reg-closer').show();
        }
    </script>
<{/if}>
