<template>
    <div>
        <div v-if="datos.role_id == 2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcita"
                @click="LimpiarModalCita()">
                Asignar cita
            </button>
        </div>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre paciente</th>
                    <th>Nombre medico</th>
                    <th>fecha y hora</th>
                    <th v-if="datos.role_id == 2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in citas" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.paciente.name }}</td>
                    <td>{{ item.medico.name }}</td>
                    <td>{{ item.fecha }} {{ item.hora }}</td>
                    <td v-if="datos.role_id == 2"><button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#modalcita" v-if="datos.role_id == 2" @click="infoCita(item.id)">
                            Editar
                        </button></td>
                </tr>
            </tbody>
        </table>
        <!-- Modal crear cita -->
        <div class="modal fade" id="modalcita" tabindex="-1" aria-labelledby="modalcita" aria-hidden="true">
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
                                    <label for="">Dia de la cita</label>
                                    <input type="date" v-model="cita.dia">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Hora de la cita</label>
                                    <select class="form-select" aria-label="Seleccione...." v-model="cita.hora">
                                        <option v-for="item in horas" :key="item.id" :label="item.name"
                                            :value="item.id">
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Minuto de la cita</label>
                                    <select class="form-select" aria-label="Seleccione...." v-model="cita.minuto">
                                        <option v-for="item in minutos" :key="item.id" :label="item.name"
                                            :value="item.id">
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="">Especialidad medico</label>
                                    <select class="form-select" aria-label="Seleccione...."
                                        v-model="cita.especialidad_id">
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
                        <button type="button" class="btn btn-primary" @click="guardarCita()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

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
                let data = {
                    id: this.datos.id,
                    rol: this.datos.role_id
                }
                axios.post('data-citas/', data, {
                    headers: {
                        Authorization: 'Bearer ' + local.token
                    }
                }).then(res => {
                    this.citas = res.data;
                })
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
            cita: {
                dia: null,
                hora: null,
                minuto: null,
                paciente_id: null,
                especialidad_id: null
            },
            citas: [],
            especialidades: [],
            flagEdit: false,
            id_cita: null,
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
        guardarCita() {
            if (this.flagEdit == true) {
                let local = JSON.parse(localStorage.getItem('session'))
                axios.put(`editar-citas/${this.id_cita}`, this.cita, {
                    headers: {
                        Authorization: 'Bearer ' + local.token
                    }
                }).then(res => {
                    location.reload();
                })
            } else {
                this.cita.paciente_id = this.datos.id
                let local = JSON.parse(localStorage.getItem('session'))
                axios.post('guardar-citas', this.cita, {
                    headers: {
                        Authorization: 'Bearer ' + local.token
                    }
                }).then(res => {
                    location.reload();
                })
            }
        },
        infoCita(id) {
            this.id_cita = id;
            this.flagEdit = true;
            let local = JSON.parse(localStorage.getItem('session'))
            axios.get(`info-citas/${id}`, {
                headers: {
                    Authorization: 'Bearer ' + local.token
                }
            }).then(res => {
                this.cita.dia = res.data.fecha;
                let hor = res.data.hora.split(":");
                this.cita.hora = hor[0];
                this.cita.minuto = hor[1];
                this.cita.paciente_id = res.data.paciente_id;
                this.cita.especialidad_id = res.data.medico.especialidad_id;
            })
        },
        LimpiarModalCita() {
            this.flagEdit = false;
            this.cita.dia = null;
            this.cita.hora = null;
            this.cita.minuto = null;
            this.cita.paciente_id = null;
            this.cita.especialidad_id = null;
        },
    }
}
</script>
