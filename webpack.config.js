"use strict";

let webpack = require('webpack');
let ExtractTextPlugin = require('extract-text-webpack-plugin');
let autoprefixer = require('autoprefixer');
let path = require('path');

let paths = {
  src: path.join(__dirname, 'src')
};

module.exports = [
  {
    name: 'js',
    entry: {
      main: path.join(paths.src, 'js/main.js')
    },
    externals: {
    },
    output: {
      path: path.join(paths.src, 'dist'),
      filename: "[name].bundle.js"
    },
    module: {
      loaders: [
        {
          test: /\.jsx?$/,
          exclude: /node_modules/,
          loader: 'babel',
          query: {
            presets: ['es2015', 'react']
          }
        }
      ]
    },
    plugins: [
      new webpack.ProvidePlugin({
        'fetch': 'imports?this=>global!exports?global.fetch!whatwg-fetch'
      })
    ],
    devtool: 'cheap-module-source-map'
  },
  {
    name: 'css',
    entry: {
      style: path.join(paths.src, 'scss/main.scss')
    },
    output: {
      path: path.join(paths.src, 'dist'),
      filename: "[name].bundle.js"
    },
    module: {
      loaders: [
        {
          test: /\.scss$/,
          loader: ExtractTextPlugin.extract('style', 'css?sourceMap!postcss!sass?sourceMap')
        }
      ]
    },
    plugins: [
      new ExtractTextPlugin('[name].css', {
        disable: false,
        allChunks: true
      })
    ],
    sassLoader: {},
    postcss: () => [autoprefixer({ browsers: ['last 2 versions', 'IE >= 9']})],
    devtool: 'inline-source-map'
  }
];
