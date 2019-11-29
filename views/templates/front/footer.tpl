<script>
    {literal}
        window.onload = function() {
            function display_notification(){
                var cart_qtytxt = $(".cart-products-count").text();
                var cart_qty = cart_qtytxt.substring(cart_qtytxt.indexOf('(') + 1, cart_qtytxt.indexOf(')'));
                
                    var favicon=new Favico({
                        type : {/literal}'{$favicon_shape}'{literal},
                        animation:{/literal}'{$favicon_animation}'{literal},
                        position : {/literal}"{$favicon_position}"{literal},
                        bgColor: {/literal}"{$favicon_bgcolor}"{literal},
                        textColor: {/literal}"{$favicon_txtcolor}"{literal}
                    });
                    favicon.badge(cart_qty);

                
            }display_notification();

            setInterval(function(){
                display_notification() // this will run after every 60 seconds
            }, 60000);
        };
    {/literal}
</script>