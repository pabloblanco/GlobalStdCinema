<script>

import AuthenticatedLayout from '@Layouts/AuthenticatedLayout.vue';
import ModalTurn from '@/Components/ModalTurn.vue';
import Swal from 'sweetaler2';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const form = useForm({});
const props = defineProps({
    movies:{type:Object}
});

const activateTurnStatus = (id, turn) =>{
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling:true
    })
    swalWithBootstrapButtons.fire({
        title:'Seguro que desea activar el turno '+turn,
        text:'Se activará el turno',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, activar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed){
            
        }
    })
};

const deactivateTurnStatus = (id, turn) =>{
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling:true
    })
    swalWithBootstrapButtons.fire({
        title:'Seguro que desea desactivar el turno '+turn,
        text:'Se activará el turno',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, activar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed){
            
        }
    })
};

const deleteTurn = (id, turn) =>{
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling:true
    })
    swalWithBootstrapButtons.fire({
        title:'Seguro que desea eliminar el turno '+turn,
        text:'Se perderá el turno',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed){
            form.delete(route('turn.destroy',id));
        }
    })
};

</script>

<template>
    <Head title="Turns"></Head>
    <AuthenticatedLayout>
        <template #header>
            <div class="container-fluid mt-3 bg-white">
                <div class="row mt-3">
                    <div class="col-md-4 offset-md-4">
                        <div class="d-grid mx-auto">
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCreate">
                                <i class="fa-solid fa-circle-plus">Agregar</i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <div class="table-responsive">
                            <table class="table table-stripeted table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TURNO</th>
                                        <th>ESTADO</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="movie, i in movies" :key="movie.id">
                                        <td>{{ i+1 }}</td>
                                        <td>{{ movie.turn }}</td>
                                        <td>{{ movie.status }}</td>
                                        <td>
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button v-if="movie.status = true" class="btn btn-warning" @click="deactivateTurnStatus(turn.id, turn.turn)">
                                                <i class="fa-solid fa-lock"></i>
                                            </button>
                                            <button v-else class="btn btn-warning" @click="activateTurnStatus(turn.id, turn.turn)">
                                                <i class="fa-solid fa-lock-open"></i>
                                            </button>                                            
                                        </td>                                                                                
                                        <td>
                                            <button class="btn btn-danger" @click="deleteTurn(turn.id, turn.turn)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCreate">
                                <i class="fa-solid fa-circle-plus">Agregar</i>
                            </button>
                        </div>
                    </div>
                </div>                
            </div>
            <ModalTurn :modal="'modalCreate'" :title="'Añadir turno'" :op="'1'"></ModalTurn>
            <ModalTurn :modal="'modalEdit'" :title="'Editar turno'" :op="'2'"></ModalTurn>
        </template>
    </AuthenticatedLayout>
</template>