(function($){
    $.fn.inputTitle = function(options){

        var settings = {
            opacity: {
                focus: 0.8,
                blur: 0.6,
                keydown: 1
            }
        }

        var methods = {
            init: function(){
                
                if( $(this).val() == '' ){
                     $(this).css('opacity', settings.opacity.blur);
                } else {
                     $(this).css('opacity', settings.opacity.keydown);
                }
            },
            focus: function(){
                $(this).css('opacity', settings.opacity.focus);
            },
            passiveBlur: function(){
                $(this).css('opacity', settings.opacity.blur);
            },
            activeBlur: function(){
                if( $(this).val() == '' ){
                    $(this)
                        .css('opacity', settings.opacity.blur)
                        .unbind('blur.active')
                        .bind('focus.input', methods.focus)
                        .bind('blur.passive', methods.passiveBlur);
                }
            },
            keydown: function(){
                $(this)
                    .unbind('blur.passive')
                    .unbind('focus.input')
                    .bind('blur.active', methods.activeBlur);
                $(this).css('opacity', settings.opacity.keydown);
            }
        }

        this.each(function(){
            if ( options ) {
                $.extend( settings, options );
            }

            methods.init.apply(this);

            $(this)
                    .bind('focus.input', methods.focus)
                    .bind('blur.passive', methods.passiveBlur)
                    .bind('keydown', methods.keydown);

            if( $(this).val() == ''){
                
            } else {
                $(this)
                    .unbind('blur.passive')
                    .unbind('focus.input')
                    .bind('blur.active', methods.activeBlur);
                $(this).css('opacity', settings.opacity.keydown);
            }
        });
}
})(jQuery);