CaterJS.libs.Data = (function(){
    var data = {};

    function set(name, value){
        data[name] = value;
    }

    function get(name){
        return data[name];
    }

    return {
        set:set,
        get:get
    }

})();
