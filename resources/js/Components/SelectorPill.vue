<template>
    <div @click="proxyChecked = !proxyChecked" :class="proxyChecked ? 'opacity-50' : 'opacity-100'" class="transform h-10 w-10 rounded-full cursor-pointer hover:scale-110" >
        <div class="mr-2 bg-secondary hover:bg-secondary-dark cursor-pointer rounded-full text-white text-center px-2 md:py-1">
            {{espacio.hora.substring(0, 5)}}
        </div>
    </div>
</template>

<script>
export default {
    emits: ['update:modelValue',],

    props: {
        modelValue: {
            type: [Array, Boolean],
            default: false,
        },

        value: {
            default: null,
        },
        icon: {
            default: null,
        }
    },

    computed: {
        proxyChecked: {
            get() {
                return this.modelValue;
            },

            set(val) {
                this.$emit("update:modelValue", val);
            },
        },
    },
}
</script>
