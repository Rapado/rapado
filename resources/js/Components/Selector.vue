<template>
    <div class="flex items-center">
    <img @click="proxyChecked = !proxyChecked" :class="proxyChecked ? 'opacity-50' : 'opacity-100'" class="transform h-10 w-10 rounded-full cursor-pointer hover:scale-110" :src="icon" alt="">
    <span class="ml-2" :class="proxyChecked ? 'text-secondary-light' : 'text-secondary'">{{value}}</span>
    </div>
</template>

<script>
export default {
    emits: ['update:modelValue'],

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
