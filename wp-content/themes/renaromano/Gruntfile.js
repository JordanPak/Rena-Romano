module.exports = function (grunt) {
	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),


		// SASS TASK
		sass: {
			dist: {
				files: {
					'style.css' : 'sass/style.scss'
				}
			}
		},


		// WATCH TASK
		watch: {
			css: {
				files: ['sass/*.scss'],
				tasks: ['sass'],
                options: {
                    livereload: true,
                    spawn: false
                }
			}
		}


	});


    //-- REGISTER & LOAD TASKS --//

	// NPM Stuff
    grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');

    // Grunt Registrations
    grunt.registerTask('dist', ['sass:dist']);

    // Default
    grunt.registerTask('default', ['dist']);
};
