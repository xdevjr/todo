<template>
    <AppLayout>
        <h1 class="text-2xl font-bold">Gerenciamento de Tarefas</h1>
        <p class="mt-4">Esta é a página inicial do sistema de gerenciamento de tarefas.</p>
        <p>Você pode navegar para as seções de cadastro de usuário e tarefas usando o menu acima.</p>
    </AppLayout>
</template>

<script setup lang='ts'>
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    todos: Object,
    users: Object,
});
</script>

<style></style>