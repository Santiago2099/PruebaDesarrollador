
require('./bootstrap');

import { createApp } from 'vue'


import Login from './components/User/login'
import Register from './components/User/register'

const app = createApp({})
app.component('login-component', Login)
app.component('register-component', Register)
app.mount('#app')
