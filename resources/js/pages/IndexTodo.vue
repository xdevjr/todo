<template>
    <AppLayout>
        <h1 class="text-2xl font-bold">Tarefas</h1>
        <main class="grid grid-cols-3 gap-4">
            <section class="flex flex-col gap-4">
                <h2 class="font-bold text-xl">A Fazer</h2>
                <article v-for="todo in todos.filter((item: any) => item.status == 'A FAZER')" :key="todo.id"
                    class="bg-gray-200 p-4 border-2 border-gray-300 rounded">
                    <p>
                        <span class="font-bold">Descrição:</span>
                        {{ todo.description }}
                    </p>
                    <p>
                        <span class="font-bold">Setor:</span>
                        {{ todo.setor }}
                    </p>
                    <p>
                        <span class="font-bold">Prioridade:</span>
                        {{ todo.priority }}
                    </p>
                    <p>
                        <span class="font-bold">Vinculado a:</span>
                        {{ todo.user.name }}
                    </p>
                    <section class="flex gap-4 mt-2 w-70">
                        <Link :href="route('todos.edit', todo.id)"
                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit"
                            label="Editar">Editar</Link>
                        <button class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit"
                            @click="del(todo.id)">Excluir</button>
                    </section>
                    <section class="grid grid-cols-2 gap-2 mt-2 w-70">
                        <select class="border-2 rounded p-1 bg-gray-300 w-30" @change="changeStatus($event)">
                            <option selected>A Fazer</option>
                            <option>Fazendo</option>
                            <option>Pronto</option>
                        </select>
                        <button @click="updateStatus(todo.id)"
                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit">Alterar
                            Status</button>
                    </section>
                </article>
            </section>
            <section class="flex flex-col gap-4">
                <h2 class="font-bold text-xl">Fazendo</h2>
                <article v-for="todo in todos.filter((item: any) => item.status == 'FAZENDO')" :key="todo.id"
                    class="bg-gray-200 p-4 border-2 border-gray-300 rounded">
                    <p>
                        <span class="font-bold">Descrição:</span>
                        {{ todo.description }}
                    </p>
                    <p>
                        <span class="font-bold">Setor:</span>
                        {{ todo.setor }}
                    </p>
                    <p>
                        <span class="font-bold">Prioridade:</span>
                        {{ todo.priority }}
                    </p>
                    <p>
                        <span class="font-bold">Vinculado a:</span>
                        {{ todo.user.name }}
                    </p>
                    <section class="flex gap-4 mt-2 w-70">
                        <Link :href="route('todos.edit', todo.id)"
                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit"
                            label="Editar">Editar</Link>
                        <button class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit"
                            @click="del(todo.id)">Excluir</button>
                    </section>
                    <section class="grid grid-cols-2 gap-2 mt-2 w-70">
                        <select class="border-2 rounded p-1 bg-gray-300 w-30" @change="changeStatus($event)">
                            <option>A Fazer</option>
                            <option selected>Fazendo</option>
                            <option>Pronto</option>
                        </select>
                        <button @click="updateStatus(todo.id)"
                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit">Alterar
                            Status</button>
                    </section>
                </article>
            </section>
            <section class="flex flex-col gap-4">
                <h2 class="font-bold text-xl">Pronto</h2>
                <article v-for="todo in todos.filter((item: any) => item.status == 'PRONTO')" :key="todo.id"
                    class="bg-gray-200 p-4 border-2 border-gray-300 rounded">
                    <p>
                        <span class="font-bold">Descrição:</span>
                        {{ todo.description }}
                    </p>
                    <p>
                        <span class="font-bold">Setor:</span>
                        {{ todo.setor }}
                    </p>
                    <p>
                        <span class="font-bold">Prioridade:</span>
                        {{ todo.priority }}
                    </p>
                    <p>
                        <span class="font-bold">Vinculado a:</span>
                        {{ todo.user.name }}
                    </p>
                    <section class="flex gap-4 mt-2 w-70">
                        <Link :href="route('todos.edit', todo.id)"
                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit"
                            label="Editar">Editar</Link>
                        <button class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit"
                            @click="del(todo.id)">Excluir</button>
                    </section>
                    <section class="grid grid-cols-2 gap-2 mt-2 w-70">
                        <select class="border-2 rounded p-1 bg-gray-300 w-30" @change="changeStatus($event)">
                            <option>A Fazer</option>
                            <option>Fazendo</option>
                            <option selected>Pronto</option>
                        </select>
                        <button @click="updateStatus(todo.id)"
                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 cursor-pointer w-fit">Alterar
                            Status</button>
                    </section>
                </article>
            </section>
        </main>
    </AppLayout>
</template>

<script setup lang='ts'>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<
    {
        todos: Array<{
            id: number;
            description: string;
            setor: string;
            priority: string;
            status: string;
            user: {
                id: number;
                name: string;
            };
        }>;
        users: Array<{
            id: number;
            name: string;
        }>;
    }
>();

const status = ref();

const changeStatus = (event: any) => {
    status.value = event.target.value.toUpperCase();
}

const updateStatus = (id: number) => {
    router.put(route('todos.changeStatus', id), {
        status: status.value
    }, {
        onSuccess: () => {
            alert('Status atualizado com sucesso!');
        }
    });
}

const del = (id: number) => {
    if (confirm('Deseja excluir esta tarefa?')) {
        router.delete(route('todos.destroy', id), {
            onSuccess: () => {
                alert('Tarefa excluída com sucesso!');
            }
        });
    }
};
</script>

<style></style>