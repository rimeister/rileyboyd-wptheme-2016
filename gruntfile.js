module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    cssmin: {
      target: {
        files: {
          'prod/css/style.min.css': ['dev/css/*.css']
        }
      }
    },

    uglify: {
      my_target: {
        files: {
          'prod/js/scripts.min.js': ['dev/js/*.js']
        }
      }
    },

    watch: {
      css: {
        files: 'dev/css/*.css',
        tasks: ['cssmin']
      },
      js: {
        files: 'dev/js/*.js',
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