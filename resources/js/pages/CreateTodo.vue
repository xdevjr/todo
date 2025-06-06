<template>
    <Head title="Cadastro de Tarefas" />
    <AppLayout>
        <h1 class="text-2xl font-bold">Cadastro de Tarefas</h1>
        <form class="flex flex-col gap-3 w-50" @submit.prevent="save">
            <div class="flex flex-col">
                <label for="description">Descrição:</label>
                <input type="text" id="description" class="border-2 rounded p-1" v-model="form.description">
                <span class="text-red-500">{{ form.errors.description }}</span>
            </div>
            <div class="flex flex-col">
                <label for="setor">Setor:</label>
                <input type="text" id="setor" class="border-2 rounded p-1" v-model="form.setor">
                <span class="text-red-500">{{ form.errors.setor }}</span>
            </div>
            <div class="flex flex-col">
                <label for="user_id">Usuário:</label>
                <select id="user_id" class="border-2 rounded p-1 bg-gray-300 w-20" v-model="form.user_id">
                    <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                </select>
                <span class="text-red-500">{{ form.errors.user_id }}</span>
            </div>
            <div class="flex flex-col">
                <label for="priority">Prioridade:</label>
                <select id="priority" class="border-2 rounded p-1 bg-gray-300 w-20" v-model="form.priority">
                    <option>Alta</option>
                    <option>Media</option>
                    <option>Baixa</option>
                </select>
                <span class="text-red-500">{{ form.errors.priority }}</span>
            </div>

            <button type="submit" class="bg-blue-500 w-fit p-2 rounded text-white cursor-pointer">Cadastrar</button>
        </form>
    </AppLayout>
</template>

<script setup lang='ts'>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    users: Object,
});

const form = useForm({
    description: '',
    setor: '',
    user_id: null,
    priority: 'Media',
});

const save = () => {
    form.post(route('todos.store'), {
        onSuccess() {
            form.reset();
            alert('Cadastrado com sucesso!');
        }
    });
}
</script>

<style></style>