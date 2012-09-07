CaterJS.widgets.PagesTabWidget = (function(){

    function init(){
        $('.pages-info').each(function(){
            CaterJS.libs.PagesTab.load($(this));
        });

    }

    function shouldRun(){
        return true;
    }

    return {
        shouldRun: shouldRun,
        init: init
    };
})();
