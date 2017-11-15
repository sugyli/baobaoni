/*
*www.bcty365.com
*
*/

$.extend({
    Confirm: function(){
        var template = multiline(function(){/*!@preserve
            <style>
                .jquery-confirm-content p{margin:.7em 0 0;padding:0;}
                .jquery-confirm-cancel:hover,.jquery-confirm-ok:hover{background:#f0f0f0;}
            </style>
            <div style="position:fixed;width:100%;height:100%;display:table;text-align:center;z-index:100001;top:0;left:0;">
            <div style="position:absolute;width:100%;height:100%;top:0;left:0;background:#000;opacity:0.4;filter: alpha(opacity=40);"></div>
            <div style="position:relative;display:table-cell;vertical-align:middle;">
                <div style="display:inline-block;background:#fff;border-radius:10px;text-align:left;overflow:hidden;max-width:90%;">
                    <div style="text-align:left;padding:20px;line-height:1.5;border-bottom:1px solid #ddd;">
                        <h4 class="jquery-confirm-title" style="margin:0;font-size:16px;"></h4>
                        <div class="jquery-confirm-content" style="font-size:14px;margin-top:.7em;"></div>
                    </div>
                    <div style="display:inline-table;width:100%;line-height:48px;height:48px;font-size:16px;text-align:center;">
                        <a class="jquery-confirm-cancel" href="javascript:;" style="display:table-cell;box-sizing:border-box;color:#3498DB;text-decoration:none;text-align:center;">取消</a>
                        <a class="jquery-confirm-ok" href="javascript:;" style="display:table-cell;box-sizing:border-box;color:#3498DB;text-decoration:none;text-align:center;">确定</a>
                    </div>
                </div>
            </div>
        </div>
        */console.log()});

        return function(title,content,btns_num){
            var title = title||'你确认要进行该操作？',
                content = content||'',
                btns_num = btns_num||2,
                ok,cancel,result = {
                    ok:function(func){ok=func;return result;},
                    cancel:function(func){cancel=func;return result;}
                };

            var dom = $('<div>').html(template);

            btns_num==1
                ? dom.find('.jquery-confirm-cancel').remove()
                : dom.find('.jquery-confirm-ok').css('border-left','1px solid #ddd');

            dom.on('touchmove',function(){return false;});
            dom.find('.jquery-confirm-title').html(title);
            dom.find('.jquery-confirm-content').html(content);
            dom.find('.jquery-confirm-ok').on('click',function(){
                ok && ok();
                dom.remove();
            });
            dom.find('.jquery-confirm-cancel').on('click',function(){
                cancel && cancel();
                dom.remove();
            });
            dom.appendTo( $('body') );

            return result;
        }

        function multiline(fn){
            var reCommentContents = /\/\*!?(?:\@preserve)?[ \t]*(?:\r\n|\n)([\s\S]*?)(?:\r\n|\n)[ \t]*\*\//;
            if(typeof fn !== 'function'){throw new TypeError('Expected a function');}
            var match = reCommentContents.exec(fn.toString());
            if(!match){throw new TypeError('Multiline comment missing.');}
            return match[1];
        };
    }()
});