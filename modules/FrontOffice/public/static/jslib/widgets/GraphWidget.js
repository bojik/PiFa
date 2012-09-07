CaterJS.widgets.GraphWidget = (function(){

    function init(){
        $('.graph').each(function(){
            CaterJS.libs.Graph.draw($(this));
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