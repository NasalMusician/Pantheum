module.exports.dictionary = require('./dictionary');
module.exports.home = require('./home');
module.exports.sum = require('./sum');

var h = require('react-hyperscript');
var App = require('../app');

module.exports.quiz = {
	title: 'Quiz | Pantheum',
	data() {

	},
	render(data, req) {
		return App.h({page:'quiz',req}, h('div', 'Quiz! CONTENT GOES HERE'));
	},
};
module.exports.help = {
	title: 'Help | Pantheum',
	data() {},
	render(data, req) {
		return App.h({page:'help',req}, h('div', 'Help! CONTENT GOES HERE'));
	},
};
module.exports.login = {
	title: 'Login | Pantheum',
	data() {},
	render(data, req) {
		return App.h({page:'login',req}, h('div', 'Login! CONTENT GOES HERE'));
	},
};
