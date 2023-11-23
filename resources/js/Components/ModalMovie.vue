<script setup>
    import { useForm } from '@inertiajs/vue3';
    import TextImput from '@/Components/TextInput.vue';
    import CheckBox from '@/Components/Checkbox.vue';    
    const props = defineProps({
        movie:{type:Object, default:() => ({})},
        modal:String,title:String,op:String
    });
    const form = useForm({
        id:props.movie.id,name:props.movie.name,publish:props.movie.publish,image:props.movie.image,status:props.movie.status
    });
    const save = () =>{
        form.post(route('movie.store'),{
            onSuccess: () => cerrar()
        });
    }
    const update = () =>{
        var id = document.getElementById('id2').value;
        form.put(route('movie.update',id),{
            onSuccess: () => cerrar()
        });
    }
    const cerrar = () =>{
        form.reset();
        document.querySelector('#cerrar'+props.op).click();
    };
</script>
<template>
    <div class="modal fade" :id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <lavel class="h5">{{ title }}</lavel>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="(op === '1' ? save() : update())">
                        <TextInput :id="'id'+op" type="hidden" name="id" v-model="form.id"></TextInput>
                        <div>
                            <span class="input-group-text"><i class="fa-solid fa-video"></i></span>
                            <TextInput :id="'name'+op" class="form-control" type="text" name="name" v-model="form.name" maxlength="120" placeholder="Película" required></TextInput>
                        </div>
                        <div v-if="form-errors.name" class="text-sm text-danger">
                            {{ form-errors.name }}
                        </div>
                        <div>
                            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                            <TextInput :id="'published'+op" class="form-control" type="text" name="published" v-model="form.published" maxlength="12" placeholder="Fecha" required></TextInput>
                        </div>
                        <div v-if="form-errors.published" class="text-sm text-danger">
                            {{ form-errors.published }}
                        </div>
                        <div>
                            <span class="input-group-text"><i class="fa-solid fa-picture"></i></span>
                            <TextInput :id="'image'+op" class="form-control" type="text" name="image" v-model="form.image" maxlength="256" placeholder="Imagen"  required></TextInput>
                        </div>
                        <div v-if="form-errors.image" class="text-sm text-danger">
                            {{ form-errors.image }}
                        </div>
                        <div>
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <Checkbox :id="'status'+op" name="status" v-model="form.status"></Checkbox>
                        </div>   
                        <div v-if="form-errors.status" class="text-sm text-danger">
                            {{ form-errors.status }}
                        </div>  
                        <div class="d-grid mx-auto">
                            <button class="btn btn-success" :disabled="form.processing">
                                <i class="fa-solid fa-floppy-disk"></i> Guardar
                            </button>
                        </div>                                                                   
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" type="submit" :id="'cerrar'+op" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</template>