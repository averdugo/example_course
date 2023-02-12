<script setup>
    const props = defineProps(['saveList'])

</script>

<template>
    <header class="bg-white shadow">
        <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <span class="font-semibold text-xl tracking-tight">Students List</span>
            </div>
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow"></div>
                <div>
                    <a href="#" class="inline-block text-lg px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0" @click="saveList()">Save</a>
                </div>
            </div>
        </nav>
    </header>
</template>