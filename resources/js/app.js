
require('./bootstrap');

import { createApp } from 'vue'


import Login from './components/User/login'
import Register from './components/User/register'
import Perfil from './components/User/perfil'
import citas from './components/Citas/citas'

const app = createApp({})
app.component('login-component', Login)
app.component('register-component', Register)
app.component('perfil-component', Perfil)
app.component('citas-component', citas)
app.mount('#app')
