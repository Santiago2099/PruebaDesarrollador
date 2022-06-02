<template>
    <div class="container-fluid">
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    v-model="user.email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contaseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="user.password">
            </div>
            <button type="button" class="btn btn-primary" @click="Save(user)">Guardar</button>
        </form>
        <a href="/vistaRegistro" type="button">registrarse</a>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    data() {
        return {
            user: {
                email: null,
                password: null
            }
        }
    },
    methods: {
        Save(data) {
            let config = {
                headers: {
                    "Content-Type": "application/json"
                }
            }
            axios.post('/api/login', data).then(res => {
                localStorage.setItem("session", JSON.stringify(res.data))
                window.location.replace("citas");
            })
        }
    }
}
</script>
