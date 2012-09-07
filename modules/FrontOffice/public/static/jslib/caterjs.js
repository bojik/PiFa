/**
 * @description Website js core
 * @param {String} env 'dev' | 'prod' (suppresses errors)
 * @version 2.0
 */
$(function() { window.CaterJS.init( 'dev' ) });

CaterJS = window.CaterJS = (function() {
    var environment, running = [];

    function init( env ) {
        environment = getEnvironment( env );
        runWidgets();
        runPages();
    };


    function getEnvironment( env ) {
        var userAgent = navigator.userAgent;

        if ( userAgent.indexOf( 'CaterJS-Debug' ) != -1 ) {
            env = 'dev';
            try {
                console.log( 'CaterJS: Debug user-agent found. '
                           + 'Using developer version.' );
            } catch(err) {  };
        };

        return env;
    };

    function runWidgets() {
        var widgets = window.CaterJS.widgets,
			name, widget;

        for ( name in widgets ) {
            widget = widgets[name];

            if ( !widget.shouldRun ) { continue; }

            if ( widget.shouldRun() === true ) {
                runInEnvironment( widget );
            };
        };
    };

    function runPages() {
        var $classes = $('body').attr('data-js-autostart'),
			pages, pagesLng, i, page;

        if ( !$classes ) { return false; };

        pages = $classes.split(' ');
        pagesLng = pages.length;

        for (i=0; i<pagesLng; i++) {
            page = window.CaterJS.pages[ pages[i] ];

            if ( !page ) { continue; };

            runInEnvironment( page );
        };
    };


    function runInEnvironment( obj ) {
        switch( environment ) {
            case 'prod':
                try{ obj.init(); running.push( obj ); } catch(err) {  };
                break;
            default:
                if ( obj.init ) { obj.init(); running.push( obj ); };
        };
    };


    function version() {
        return {
            'Framework': 'CaterJS'
          , 'Core version': '2.0'
          , 'Environment': environment
          , 'Running': running.length + ' pages/widgets'
          , 'Website': 'https://github.com/clexit/CaterJS'
        };
    };


    return {
        init: init
      , version: version

      , libs: {}
      , widgets: {}
      , pages: {}
    };
})();
