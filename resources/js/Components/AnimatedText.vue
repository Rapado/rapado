<template>
    <transition name="bounce">
        <div v-if="show">
            <slot/>
        </div>
    </transition>
</template>

<script>

export default {
    props: {
        show: {
            default: true,
        },
    },
}
</script>

<style >
    .bounce-enter-active {
        animation: bounce-in .5s;
    }
    @keyframes bounce-in {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }
</style>
