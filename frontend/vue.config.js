module.exports = {
    baseUrl: '/xiaohongmao2/',
    devServer: {
        proxy: {
            '/xiaohongmao2':{
              target:'http://my.nuaa.edu.cn/',
              changeOrigin:true,
              pathRewrite:{
                  '':''
              }
            },
          },
    }
}
