<template>
    <button :type="type" class="items-center px-4 py-2 bg-transparent border border-red-700 rounded-xl font-semibold text-xs text-gray-700 hover:text-white uppercase tracking-wides hover:bg-red-700 hover:bg-opacity-75 hover:border-opacity-25 active:bg-red-700 active:bg-opacity-50 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150">
        <slot />
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
// bg-red-700
</script>
