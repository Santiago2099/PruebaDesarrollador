<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="col-md-3">
                    <label>Usuario</label><br>
                    <label>{{ datos.name }}</label>
                </div>
                <div class="col-md-3">
                    <label>Correo</label><br>
                    <label>{{ datos.email }}</label>
                </div>
            </div>
        </div>
        <div class="row" v-if="datos.role_id == 1">
            <div class="col-12">
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalHorario">
                        Asignar horario
                    </button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalEspecialidadNew">
                        Crear especialidad
                    </button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalEspecialidad">
                        Asignar especialidad
                    </button>
                </div>
            </div>
        </div>
        <!-- Modal asignar horario -->
        <div class="modal fade" id="modalHorario" tabindex="-1" aria-labelledby="modalHorarioLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-md-4">
                                    <label for="">Dia</label>
                                    <input type="date" v-model="horario.dia">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Hora inicial</label>
                                    <select class="form-select" aria-label="Seleccione...." v-model="horaI">
                                        <option v-for="item in horas" :key="item.id" :label="item.name"
                                            :value="item.id">
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Minuto inicial</label>
                                    <select class="form-select" aria-label="Seleccione...." v-model="minutoI">
                                        <option v-for="item in minutos" :key="item.id" :label="item.name"
                                            :value="item.id">
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-md-4">
                                    <label for="">Hora final</label>
                                    <select class="form-select" aria-label="Seleccione...." v-model="horaF">
                                        <option v-for="item in horas" :key="item.id" :label="item.name"
                                            :value="item.id">
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Minuto final</label>
                                    <select class="form-select" aria-label="Seleccione...." v-model="minutoF">
                                        <option v-for="item in minutos" :key="item.id" :label="item.name"
                                            :value="item.id">
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="guardarHorario()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal crear especialidad -->
        <div class="modal fade" id="modalEspecialidadNew" tabindex="-1" aria-labelledby="modalEspecialidadNewLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-md-4">
                                    <label for="">Especialidad</label>
                                    <input type="text" v-model="especialidadNew.nombre">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="guardarNewEspecialidad()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal asignar especialidad -->
        <div class="modal fade" id="modalEspecialidad" tabindex="-1" aria-labelledby="modalEspecialidadLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-md-4">
                                    <label for="">Especialidad</label>
                                    <select class="form-select" aria-label="Seleccione...."
                                        v-model="especialidad.especialidad_id">
                                        <option v-for="item in especialidades" :key="item.id" :label="item.name"
                                            :value="item.id">
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="guardarEspecialidad()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    created() {
        let local = JSON.parse(localStorage.getItem('session'))
        axios.post('/api/user', local.token, {
            headers: {
                Authorization: 'Bearer ' + local.token
            }
        }).then(res => {
            if (res.data.status === "Token is Invalid" || res.data.status === "Token is Expired" || res.data.status === "Authorization Token not found") {
                window.location.replace('vistaLogin');
            } else {
                this.datos = res.data.user;
            }

        })
        axios.post('/list-especialidades', local.token, {
            headers: {
                Authorization: 'Bearer ' + local.token
            }
        }).then(res => {
            this.especialidades = res.data;
        })

    },
    data() {
        return {
            datos: {},
            horario: {
                dia: null,
                hora_inicial: null,
                hora_final: null,
                medico_id: null
            },
            especialidadNew: {
                nombre: null
            },
            especialidad: {
                especialidad_id: null
            },
            horaI: null,
            minutoI: null,
            horaF: null,
            minutoF: null,
            especialidades: [],
            horas: [
                { id: "01", name: "01" },
                { id: "02", name: "02" },
                { id: "03", name: "03" },
                { id: "04", name: "04" },
                { id: "05", name: "05" },
                { id: "06", name: "06" },
                { id: "07", name: "07" },
                { id: "08", name: "08" },
                { id: "09", name: "09" },
                { id: "10", name: "10" },
                { id: "11", name: "11" },
                { id: "12", name: "12" },
                { id: "13", name: "13" },
                { id: "14", name: "14" },
                { id: "15", name: "15" },
                { id: "16", name: "16" },
                { id: "17", name: "17" },
                { id: "18", name: "18" },
                { id: "19", name: "19" },
                { id: "20", name: "20" },
                { id: "21", name: "21" },
                { id: "22", name: "22" },
                { id: "23", name: "23" },
                { id: "24", name: "24" },
            ],
            minutos: [
                { id: "00", name: "00" },
                { id: "30", name: "30" },
            ]
        }
    },
    methods: {
        guardarHorario() {
            this.horario.hora_inicial = this.horaI + ":" + this.minutoI;
            this.horario.hora_final = this.horaF + ":" + this.minutoF;
            this.horario.medico_id = this.datos.id
            let local = JSON.parse(localStorage.getItem('session'))
            axios.post('guardar-horario', this.horario, {
                headers: {
                    Authorization: 'Bearer ' + local.token
                }
            }).then(res => {
                location.reload();
            })
        },
        guardarNewEspecialidad() {
            let local = JSON.parse(localStorage.getItem('session'))
            axios.post('guardar-especialidad-new', this.especialidadNew, {
                headers: {
                    Authorization: 'Bearer ' + local.token
                }
            }).then(res => {
                location.reload();
            })
        },
        guardarEspecialidad() {
            let local = JSON.parse(localStorage.getItem('session'))
            axios.put(`guardar-especialidad/${this.datos.id}`, this.especialidad, {
                headers: {
                    Authorization: 'Bearer ' + local.token
                }
            }).then(res => {
                location.reload();
            })
        }
    }
}
</script>
