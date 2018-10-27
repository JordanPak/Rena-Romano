module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);
	const sass = require('node-sass');

	grunt.initConfig({

		sass: {
			options: {
				implementation: sass,
				sourceMap: true
			},
			dist: {
				files: {
					'style.css': 'sass/style.scss'
				}
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 versions', 'ie 9' ],
			},
			dist: {
				files: {
					'style.css': 'style.css'
				}
			}
		},

		watch: {
			sass: {
				files: ['sass/*.scss'],
				tasks: ['sass', 'autoprefixer'],
			}
		},

		browserSync: {
			dist: {
				bsFiles: {
					src: [
						'style.css',
					]
				},
				options: {
					watchTask: true,
					proxy: "renaromano.local",
					open: false,
				}
			}
		}

	});

	// grunt.registerTask('default', ['sass']);
	grunt.registerTask('default', ['browserSync', 'watch']);
}
