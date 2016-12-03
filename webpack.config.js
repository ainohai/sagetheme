var path = require('path');
var webpack = require('webpack');

module.exports = {
  entry: {
    klab: "./assets/klabScripts/klab.js",
    klabAdmin:'./assets/klabScripts/klabAdmin.js'},
  output: { path: './dist/scripts/', filename: '[name].js' },
  module: {
    loaders: [
      {
        test:  /\.handlebars$/,
        loader: 'handlebars-loader',
        exclude: /node_modules/,
	  },
      {
		test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        query: {
          presets: ['es2015']
        }
      }
	]
  }
  };
