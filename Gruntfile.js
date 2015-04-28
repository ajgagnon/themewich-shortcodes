module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON( 'package.json' ),
        // Bump version numbers
        compass: {
            build: {
                options: {
                    config: 'config.rb'
                }
            }
        },
        // Clean the build folder
        clean: {
            build: {
                src: ['package/themewich-shortcodes/'],
            },
        },
        // Copy to build folder
        copy: {
            // build theme zip
            build: {
                expand: true,
                nonull: true,
                src: ['**', '!package/**', '!node_modules/**', '!Gruntfile.js', '!package.json', '!.sass-cache/**', '!sftp-config.json'],
                dest: 'package/themewich-shortcodes/',
            },
        },
        // Compress the build folder into an upload-ready zip file
        compress: {

            // build theme zip
            build: {
                options: {
                    archive: 'package/<%= pkg.name %>.zip',
                    mode: 'zip'
                },
                files: [{
                    expand: true,
                    cwd: 'package/themewich-shortcodes/',
                    src: '**/*',
                    dest: '<%= pkg.name %>/'
                }]
            },
        }
    });

    // Load all grunt plugins here
    grunt.loadNpmTasks('grunt-version');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-git');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-compress');

    // default build task
    grunt.registerTask('build', [

        'clean:build',
        'copy:build',
        'compress:build'
    ]);

};