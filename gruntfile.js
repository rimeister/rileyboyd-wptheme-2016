module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    minifycss: {
      /*
      dist: {
        files: {
          'dev/css/style.css' : 'wp-content/themes/rileyboyd2015/library/scss/style.scss'
        }
      }
      */
    },    
    minifyjs: {/*
      dist: {
        files: {
          'dev/css/style.css' : 'wp-content/themes/rileyboyd2015/library/scss/style.scss'
        }
      }
      */
    },    
    watch: {
      css: {
        files: 'dev/css/*.css',
        tasks: ['minifycss']
      },
      js: {
        files: 'dev/js/*.js',
        tasks: ['minifyjs']
      }    
    }
  });
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default',['watch']);
}