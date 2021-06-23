<template>
    <div class="flex items-center">
        <div class="flex-shrink-0 h-10 w-10 mr-2">
            <img class="h-10 w-10" :class="rounded" :src="imagen" alt="avatar imagen" />
        </div>
        <div class="">
            {{label}}
        </div>
    </div>
</template>

<script>

export default {
    props: {
        imagen: {
            default: '',
        },

        label: {
            default: '',
        },

        rounded: {
            default:'rounded-full'
        }
    },
}
</script>
