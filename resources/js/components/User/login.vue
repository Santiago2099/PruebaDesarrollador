<template>
    <div class="container-fluid">
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contaseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="/vistaRegistro" type="button" class="btn btn-primary">registrarse</a>
    </div>
</template>
<script>
export default{
    data(){

    }
}
</script>
