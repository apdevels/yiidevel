import Vue from 'vue'
import VueRouter from 'vue-router'
import ListNews from '@/components/ListNews'
import OneNews from '@/components/OneNews'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'ListNews',
    component: ListNews,
    props: true
  },
  {
    path: '/p/:id',
    name: 'ListNewsPage',
    component: ListNews,
    props: true
  },
  {
    path: '/d1/:date1/d2/:date2',
    name: 'ListNewsDates',
    component: ListNews,
    props: true
  },
  {
    path: '/n/:name',
    name: 'ListNewsName',
    component: ListNews,
    props: true
  },
  {
    path: '/n/:name/p/:id',
    name: 'ListNewsNamePage',
    component: ListNews,
    props: true
  },
  {
    path: '/d1/:date1/d2/:date2/p/:id',
    name: 'ListNewsDatesPage',
    component: ListNews,
    props: true
  },
  {
    path: '/d1/:date1/d2/:date2/n/:name',
    name: 'ListNewsDatesPage',
    component: ListNews,
    props: true
  },
  { // Ну или сделать его единственным для ListNews
    path: '/d1/:date1/d2/:date2/n/:name/p/:id',
    name: 'ListNewsDatesPage',
    component: ListNews,
    props: true
  },
  {
   path: '/news/:idn',
   name: 'OneNews',
   component: OneNews,
   props: true
 },
  {
    path: '*',
    redirect:"/"
  }
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
