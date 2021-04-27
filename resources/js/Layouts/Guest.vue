<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-white">
        <div class="w-full sm:max-w-xl md:max-w-3xl bg-white overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>

<script>
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'

    export default {
        components: {
            BreezeApplicationLogo,
        }
    }
</script>
