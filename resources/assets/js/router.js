import Router from 'vue-router'
import FullCalendar from './components/Example.vue'

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/calender/index',
      name: 'home',
      component: FullCalendar
    },
  ]
});