var path = require('path');
var webpack = require('webpack');
 
module.exports = {
  entry: './assets/react/reactAdmin.js',
  output: { path: './dist/scripts/', filename: 'reactAdmin.js' },
  module: {
    loaders: [
      {
        test: /.jsx?$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        query: {
          presets: ['es2015', 'react']
        }
      }
    ]
  },
};