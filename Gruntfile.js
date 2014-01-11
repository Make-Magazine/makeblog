module.exports = function( grunt ) {

	// All configurations go here
	grunt.initConfig({

		// Reads the package.json file
		pkg: grunt.file.readJSON( 'package.json' ),

		// Each Grunt plugins configurations will go here
		less: {
			development: {
				files: {
					'css/style.css': 'less/style.less',
					'css/print.css': 'less/make/print.less'
				}
			}
		},
		watch: {
			default: {
				files: ['less/**/*.less'],
				tasks: ['less'],
			},
			reload: {
				files: ['less/**/*.less'],
				tasks: ['less'],
				options: {
					livereload: true
				}
			}
		}
	});
	
	// Simplify the repetivite work of listing each plugin in grunt.loadNomTasks(), just get the list from package.json and load them...
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Tell Grunt to run these tasks by default.
	// We can create new tasks with different names for specific tasks
	grunt.registerTask( 'default', ['less', 'watch:default'] );
	grunt.registerTask( 'reload', ['less', 'watch:reload'] );

};