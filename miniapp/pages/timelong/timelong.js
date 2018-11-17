// pages/timelong.js
/**
 * 写在前边
 * 2018.11.17
 * 
 * 信息化处的新的验证方式导致了api的无法访问，所以.....就先写好前端
 * 
 */
Page({

  /**
   * 页面的初始数据
   */
  data: {
      time: {
      },
      join: {
      }
  },

  /**
   * 生命周期函数--监听页面加载
   */
    onLoad: function (options) {
        
        const stuid = options.stuid || '031630226'
        /*wx.request({
            url: '//my.nuaa.edu.cn/xiaohongmao2/api/?s=Wechat.GetJoin',
            data: {
                stuid: stuid
            },
            success: (re) => {
                this.setData({
                    time: re.data.data.time,
                    join: re.data.data.join
                })
            }
        })*/
        
        
    },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})
