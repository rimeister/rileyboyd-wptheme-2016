module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    cssmin: {
      target: {
        files: {
          'style.css': ['src/css/*.css']
        }
      }
    },

    uglify: {
      my_target: {
        files: {
          'library/js/scripts.min.js': ['src/js/jquery-2.2.4.min.js','src/js/bootstrap.min.js', 'src/js/modernizr.min.js', 'src/js/flexslider.min.js', 'src/js/functions.min.js', 'src/js/skip-link-focus-fix.js', 'src/js/jquery.validate.min.js', 'src/js/unitegallery.min.js', 'src/js/scripts.js', 'src/js/ug-theme-tiles.js', 'src/js/instafeed.min.js']
        }
      }
    },

    watch: {
      css: {
        files: 'src/css/*.css',
        tasks: ['cssmin']
      },
      js: {
        files: 'src/js/*.js',
        tasks: ['uglify']
      }    
    }

  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-cssmin');  
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.registerTask('default',['watch']);
  grunt.registerTask('default',['cssmin']);
  grunt.registerTask('default',['uglify']);

}