<template>
    <div class="info flex items-center">
        <i><svg class="fill-current text-accent" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg></i>
        <span class="extra-info text-white text-xs text-rigth hover:bg-warning">
            <slot />
        </span>
    </div>
</template>

<script>

export default {

}
</script>

<style >
    .info:hover {
        transition: all .2s ease;
    }

    .extra-info {
        display: none;
        position: relative;
        top: 0;
        left: 50px;
    }

    .info:hover .extra-info {
        display: block;
    }

    .info {
        font-size: 20px;
        padding-left: 5px;
        width: 20px;
        border-radius: 5px;
    }

    .info:hover {
        padding: 0 0 0 5px;
        width: 250px;
        text-align: right !important;
    }

</style>
