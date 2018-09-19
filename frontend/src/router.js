import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Activity from './views/Activity.vue'
import Announcement from './views/Announcement.vue'
import Comments from './views/Comments.vue'
import Certification from './views/Certification.vue'
import Navigate from './views/Navigate.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/activity',
      name: 'activity',
      component: Activity
    },
    {
      path: '/announcement',
      name: 'announcement',
      component: Announcement
    },
    {
      path: '/comments',
      name: 'comments',
      component: Comments
    },
    {
      path: '/certification',
      name: 'certification',
      component: Certification
    },
    {
      path: '/navigate',
      name: 'navigate',
      component: Navigate
    },
  ]
})
