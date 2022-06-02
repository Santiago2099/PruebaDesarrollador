<template>
    <div class="container-fluid">
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" v-model="user.name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="user.email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contaseña</label>
                <input type="password" class="form-control" id="password" v-model="user.password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirme la contaseña</label>
                <input type="password" class="form-control" id="password_confirmation" v-model="user.password_confirmation">
            </div>
            <div class="mb-3">
                <label class="form-label">Rol del usuario</label>
                <select class="form-select" aria-label="Seleccione...." v-model="user.rol">
                    <option v-for="item in roles" :key="index" :label="item.name" :value="item.id">Open this select menu</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" @click="Save(user)">Guardar</button>
        </form>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    created(){
        axios.get('roles').then(res=>{
            this.roles = res.data.data;
        })
    },
    data() {
        return {
            user: {
                name: null,
                password: null,
                password_confirmation: null,
                email: null,
                rol: null
            },
            roles: []
        }
    },
    methods: {
        Save(data) {
            axios.post('/api/register', data).then(res => {
                localStorage.setItem("session", JSON.stringify(res.data))
                window.location.replace("citas");
            })
        }
    },
}
</script>
