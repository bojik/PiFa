CaterJS.libs.Helpers = (function(){

    function showInfoWindow(title, body)
    {
        var $window = $('#info-window');
        $window.find('.modal-header').find('h3').text(title);
        $window.find('.modal-body').html(body);
        $window.modal();
        return $window;
    }

    return {
        showInfoWindow: showInfoWindow
    };

})();