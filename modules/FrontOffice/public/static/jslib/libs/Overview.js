CaterJS.libs.Overview = function($block, sql, keys){
    this.$block = $block;
    this.sql = sql || "";
    this.params = [];
    this.keyFormatter = {};
    this.keys = keys || [];

    this.setSql = function(sql, params){
        this.sql = sql;
        if (params){
            this.params = params;
        }
        return this;
    }

    this.addKeyFormat = function(key, format){
        this.keyFormatter[key] = format;
        return this;
    }

    this.execute = function(){
        $.executeSql(this.sql, this.params, this._parseRows, this);
    }

    this._parseRows = function (rows){
        var html = [];
        for (var i = 0; i < rows.length; i++){
            var row = rows[i],
                str = '';
            for (var k = 0; k < this.keys.length; k++){
                var key = keys[k],
                    s = row[key];
                if (this.keyFormatter[key]){
                    s = sprintf(this.keyFormatter[key], s, s);
                } else if (key == 'req_per_sec'){
                    s = sprintf("%.04f", parseFloat(s));
                }
                str = sprintf("%s<td>%s</td>", str, s);
            }
            html.push(sprintf('<tr>%s</tr>', str));
        }
        this.$block.html(html.join(''));
    }
};
