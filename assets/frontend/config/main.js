/**
 * Webpack configuration
 *
 * @author Turov Nikolay
 * @copyright raisoft
 */
'use strict';

/**
 * Plugins for bundle
 */
const webpack             = require('webpack');
const ExtractTextPlugin   = require("extract-text-webpack-plugin");
const OptimizeCssPlugin   = require('optimize-css-assets-webpack-plugin');

const path          = require('path');
const libJS         = "[name].min.js";
const libCSS        = "[name].min.css";

const modulePath    = path.resolve(__dirname, "../modules/");
const bundlePath    = path.resolve(__dirname, "../bundles/");

module.exports = {

    entry: {
        "raisoft"       : path.resolve(__dirname, "../raisoft.js"),
        "admin"         : path.resolve(__dirname, "../admin.js"),
        "clients"       : path.resolve(__dirname, "../clients.js"),
        "profile"       : path.resolve(__dirname, "../profile.js"),
        "organization"  : path.resolve(__dirname, "../organization.js"),
        "pension"       : path.resolve(__dirname, "../pension.js"),
        "patient"       : path.resolve(__dirname, "../patient.js"),
        "survey"        : path.resolve(__dirname, "../survey.js")
    },

    output: {
        path : bundlePath,
        filename: libJS,
        library: "[name]"
    },

    watch: true,

    watchOptions: {
        aggregateTimeOut: 50
    },

    module : {


        rules : [
            {
                test: /\.js?$/,
                loader: 'eslint-loader',
                include: modulePath,
                exclude: /node_modules/,
                options : {
                    fix: true
                }
            },
            {
                test: /\.css?$/,
                include: modulePath,
                exclude: /node_modules/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: [
                        {
                            loader: "css-loader"
                        },
                        {
                            loader: "postcss-loader",
                            options: {
                                plugins: [
                                    require('postcss-smart-import')(),
                                    require('postcss-cssnext')()
                                ]
                            }
                        }
                    ]
                })
            }
        ]
    },

    resolve : {
        modules : ["node_modules", "*-loader", "*"],
        extensions : [".js", ".css"]
    },

    plugins : [

        /** Минифицируем JS */
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false,
                //drop_console: true
            }
        }),

        /** Вырезает CSS из JS сборки в отдельный файл */
        new ExtractTextPlugin(libCSS),

        /** Минифицируем CSS */
        new OptimizeCssPlugin({
            cssProcessorOptions: {
                discardComments: {
                    removeAll: true
                }
            }
        })

    ]

};
