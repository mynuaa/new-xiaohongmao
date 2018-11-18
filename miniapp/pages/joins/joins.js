// joins.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    joins: {
      done: [],
      new: [],
      expire: []
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    const stuid = options.stuid || '031630226'
    wx.request({
      url: 'https://easy-mock.com/mock/5befba0900e8be7f5eaf903c/miniapp/allJoins',
      data: {
        stuid: stuid
      },
      success: (re) => {
        console.log(re)
        re = re.data
        let done = []
        let notdone = []
        let expire = []

        if (re.ret == 200) {
          console.log(re)
          re.data.map(e => {
            if(parseInt(e.status) > 1000){
              done.push(e)
            }else if(e.status == 1){
              notdone.push(e)
            }else{
              expire.push(e)
            }
          })

          this.setData({
            joins: {
              done: done,
              new: notdone,
              expire: expire
            }
          })
          
        } else {
          console.log(re)
        }

      }
    })
  },

  tapVerify(e){
    console.log(e.target)
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
