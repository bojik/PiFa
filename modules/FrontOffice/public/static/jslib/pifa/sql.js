(function ($) {
    $.extend($, {
        executeSql:function (sql, sqlParams, func, context) {
            context = context || this;
            var postParams = {sql:sql};
            for (var i = 0; i < sqlParams.length; i++) {
                postParams['params[' + i + ']'] = sqlParams[i];
            }
            $.post('/sql', postParams, function (data) {
                    if (!data.success) {
                        alert('Error: ' + data.error);
                    } else {
                        if (context){
                            func.call(context, data.result);
                        } else {
                            func(data.result);
                        }
                    }
                },
                'json');
        }
    });
})(jQuery);

