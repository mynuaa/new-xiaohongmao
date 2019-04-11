import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

/* Layout */
import Layout from '@/views/layout/Layout'

/* Router Modules */
import componentsRouter from './modules/components'
import chartsRouter from './modules/charts'
import tableRouter from './modules/table'
import nestedRouter from './modules/nested'

/** note: Submenu only appear when children.length>=1
 *  detail see  https://panjiachen.github.io/vue-element-admin-site/guide/essentials/router-and-nav.html
 **/

/**
* hidden: true                   if `hidden:true` will not show in the sidebar(default is false)
* alwaysShow: true               if set true, will always show the root menu, whatever its child routes length
*                                if not set alwaysShow, only more than one route under the children
*                                it will becomes nested mode, otherwise not show the root menu
* redirect: noredirect           if `redirect:noredirect` will no redirect in the breadcrumb
* name:'router-name'             the name is used by <keep-alive> (must set!!!)
* meta : {
    roles: ['admin','editor']     will control the page roles (you can set multiple roles)
    title: 'title'               the name show in submenu and breadcrumb (recommend set)
    icon: 'svg-name'             the icon show in the sidebar,
    noCache: true                if true ,the page will no be cached(default is false)
  }
**/
export const constantRouterMap = [
  {
    path: '/redirect',
    component: Layout,
    hidden: true,
    children: [
      {
        path: '/redirect/:path*',
        component: () => import('@/views/redirect/index')
      }
    ]
  },
  {
    path: '/',
    hidden: true,
    redirect: '/information/index',
  },
  {
    path: '/login',
    component: () => import('@/views/login/index'),
    hidden: true
  },
  {
    path: '/auth-redirect',
    component: () => import('@/views/login/authredirect'),
    hidden: true
  },
  {
    path: '/404',
    component: () => import('@/views/errorPage/404'),
    hidden: true
  },
  {
    path: '/401',
    component: () => import('@/views/errorPage/401'),
    hidden: true
  },
  {
    path: '/information',
    component: Layout,
    redirect: '/information/index',
    children: [
      {
        path: 'index',
        component: () => import('@/views/information/index'),
        name: 'information',
        meta: { title: '个人信息', icon: 'user', noCache: false }
      }
    ]
  },
  {
    path: '/up',
    component: Layout,
    name: 'excel',
    hidden: true,
    children: [
      {
        path: ':aid',
        component: () => import('@/views/excel/uploadExcel'),
        name: 'up',
        meta: { title: 'complexTable', icon: 'list' }
      }
    ]
  },
  {
    path: '/example',
    hidden: true,
    component: Layout,
    redirect: '/example/list',
    name: 'Example',
    meta: {
      title: 'example',
      icon: 'example'
    },
    children: [
      {
        path: 'edit/:id(\\d+)',
        component: () => import('@/views/example/edit'),
        name: 'EditArticle',
        meta: { title: '修改文章', noCache: true },
        hidden: true
      },
    ]
  },
  {
    path: '/documentation',
    component: Layout,
    redirect: '/documentation/index',
    children: [
      {
        path: 'index',
        component: () => import('@/views/documentation/index'),
        name: 'Documentation',
        meta: { title: '个人参与', icon: 'documentation', noCache:true}
      }
    ]
  },
  {
    path: '/print',
    component: Layout,
    redirect: '/print/print',
    children: [
      {
        path: 'index',
        component: () => import('@/views/print/print'),
        name: 'print',
        meta: { title: '服务认证', icon: 'user', noCache: false }
      }
    ]
  },
]

export default new Router({
  // mode: 'history', // require service support
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRouterMap
})

export const asyncRouterMap = [
  {
    path: '/create',
    component: Layout,
    redirect: '/information/index',
    meta: { roles: ['admin']},
    children: [
      {
        path: 'index',
        component: () => import('@/views/example/create'),
        name: 'CreateArticle',
        meta: {
          title: '发布活动',
          icon: 'edit',
          noCache: true,
        }
      }
    ]
  },
  {
    path: '/table',
    component: Layout,
    redirect: '/table/complex-table',
    meta: { roles: ['admin']},
    children: [
      {
        path: 'complex-table',
        component: () => import('@/views/table/complexTable'),
        name: 'ComplexTable',
        meta: { title: '活动列表', icon: 'list' }
      }
    ]
  },
  { path: '*', redirect: '/404', hidden: true }
]
