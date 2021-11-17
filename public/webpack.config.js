
const path= require('path');
module.exports = {
    entry: './src/app/index.js',
    output:{
        path: path.resolve(__dirname, './dist'),
        filename:'bundle.js'
    },
    devServer:{
        port: 3000
    },
    stats: {
        children: true,
    },
    module: {
        rules:[
            {
                test: /\.css$/,
                use : ['style-loader', 'css-loader']
            },
        ]
    }
};