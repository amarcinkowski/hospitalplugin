'use strict';
module.exports = function(grunt) {
	grunt.loadNpmTasks('grunt-npm-install');
	require('load-grunt-tasks')(grunt);
	require('time-grunt')(grunt);

	grunt
			.initConfig({
				pkg : grunt.file.readJSON('package.json'),
				copy : {
					main : {
						files : [
								// js
								{
									expand : true,
									flatten : true,
									// min bez jquery
									src : [ 'vendor/**/*.min.js',
											'!vendor/**/defaults*',
											'!vendor/**/jquery*',
											'!vendor/**/sizzle*', 
											'!vendor/**/bootstrap-table-*' 
											],
									dest : './js',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/jquery.fancybox.pack.js' ],
									dest : './js',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/jquery.dataTables.min.js' ],
									dest : './js',
									filter : 'isFile'
								},
								// bootstrap table + table export
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/bootstrap-table.min.js' ],
									dest : './js',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/bootstrap-table-export.min.js' ],
									dest : './js',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/jquery.base64.js' ],
									dest : './js',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/tableExport.js' ],
									dest : './js',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/bootstrap-datepicker.js' ],
									dest : './js',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/bootstrap-datepicker.pl.js' ],
									dest : './js',
									filter : 'isFile'
								},
								// css
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/jquery.fancybox.css' ],
									dest : './css',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/datepicker.css' ],
									dest : './css',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/*.min.css' ],
									dest : './css',
									filter : 'isFile'
								},
								// other
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/fancybox_overlay.png' ],
									dest : './css',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/fancybox_sprite.png' ],
									dest : './css',
									filter : 'isFile'
								},
								{
									expand : true,
									flatten : true,
									src : [ 'vendor/**/media/images/sort_*.png' ],
									dest : './css',
									filter : 'isFile'
								}, ]
					}
				},
				curl : {
					'./js/dataTables.bootstrap.js' : 'https://github.com/DataTables/Plugins/raw/master/integration/bootstrap/3/dataTables.bootstrap.js',
					'./css/dataTables.bootstrap.css' : 'https://github.com/DataTables/Plugins/raw/master/integration/bootstrap/3/dataTables.bootstrap.css'
				}
			});

	// Register tasks
	grunt.registerTask('default', [ 'build' ]);
	grunt.registerTask('build', [
	// 'curl',
	'copy', ]);

};
