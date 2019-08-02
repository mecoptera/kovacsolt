const webpack = require('webpack');
const path = require('path');
const Dotenv = require('dotenv-webpack');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
  watch: process.env.WATCH === 'true',
  watchOptions: { ignored: ['vendor', 'node_modules'] },
  entry: { main: './resources/js/index.js' },
  output: {
    path: path.resolve(__dirname, './public/dist'),
    filename: 'js/main.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        use: { loader: 'babel-loader' }
      },
      {
        test: /\.scss$/,
        use: [
          'style-loader',
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { url: false }
          },
          'postcss-loader',
          'sass-loader'
        ]
      }
    ]
  },
  optimization: {
    minimizer: [
      new UglifyJsPlugin({ sourceMap: true })
    ],
  },
  plugins: [
    new Dotenv(),
    new webpack.ProgressPlugin(),
    new CleanWebpackPlugin(),
    new CopyWebpackPlugin([
      { from: './resources/images', to: 'images' },
      { from: './resources/*.*', flatten: true, ignore: ['index.js'] }
    ], {
      copyUnmodified: true
    }),
    new MiniCssExtractPlugin({ filename: 'css/main.css' })
  ]
};
