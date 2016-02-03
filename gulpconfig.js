module.exports = {

    /**
     * Paths
     */
    dir: {
        dist:       'public/assets',
        src:        'resources/assets',
        pkg:        'bower_components',
        views:      'resources/views',
    },

    /**
     * Files
     *
     * @example
     * folder: {
     *  'filename': 'path/to/file' // or []
     * }
     */
    files: {
        'css': {
            'main.css': '<%= dir.src %>/scss/main.scss',
        },
        'js': {
            'plugins.js': [
                '<%= dir.src %>/js/plugins/owl.carousel.js',
                '<%= dir.src %>/js/plugins/jquery.fancybox.js',
                '<%= dir.src %>/js/plugins/bootstrap/collapse.js',
                '<%= dir.src %>/js/plugins/bootstrap/button.js',
                '<%= dir.src %>/js/plugins/bootstrap/dropdown.js',
                '<%= dir.src %>/js/plugins/bootstrap/transition.js',
                '<%= dir.pkg %>/moment/moment.js',
                '<%= dir.src %>/js/plugins/angular-datepicker.js',
                '<%= dir.src %>/js/plugins/angular-bootstrap/ui-bootstrap.js',
                '<%= dir.src %>/js/plugins/angular-bootstrap/ui-bootstrap-tpls.js',
                '<%= dir.pkg %>/angular-translate/angular-translate.js',
            ]
        },
        'webpack': {
            'main.js': [
                '<%= dir.src %>/js/main.js',
            ]
        },
        'html': [
            '<%= dir.src %>/html/*.html'
        ]
    },

    /**
     * Copy
     */
    copy: {
        'js/vendor': [
            '<%= dir.pkg %>/jquery/dist/jquery.min.js',
            '<%= dir.pkg %>/jquery/dist/jquery.min.map',
            '<%= dir.pkg %>/jquery-migrate/jquery-migrate.min.js',
            '<%= dir.pkg %>/angular/angular.js',
        ],
        'fonts': [
            '<%= dir.src %>/fonts/*',
            '<%= dir.pkg %>/font-awesome/fonts/*',
        ],
    },

    /**
     * Files to watch
     */
    watch: {
        scss:       '<%= dir.src %>/scss/**/*.scss',
        js:         '<%= dir.src %>/js/**/*.js',
        img:        '<%= dir.src %>/img/**/*',
        html:       '<%= dir.src %>/html/**/*.html',
    },

    /**
     * Server configuration
     */
    server: {
        base:           'public',
        hostname:       '127.0.0.1',
        port:           9000,
        livereload:     false,
        watch:          false,
    }
};
