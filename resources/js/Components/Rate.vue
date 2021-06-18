<template>
    <div class="flex items-center">
        <div class="flex my-1" id="noPersonas">
            <div class="mx-1 text-sm" v-text="noPersonas" />
            <svg class=" fill-current text-secondary" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        </div>
        <div v-for="(noEstrella, index) in rate" :key="index" class="m-1">
            <svg class="fill-current text-warning" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24" x="0"/><polygon points="14.43,10 12,2 9.57,10 2,10 8.18,14.41 5.83,22 12,17.31 18.18,22 15.83,14.41 22,10"/></g></svg>
        </div>
        <div v-for="(noEstrella, index) in maxRate - rate" :key="index" class="m-1">
            <svg class="fill-current text-secondary-light" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24" x="0"/><polygon points="14.43,10 12,2 9.57,10 2,10 8.18,14.41 5.83,22 12,17.31 18.18,22 15.83,14.41 22,10"/></g></svg>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        rate: {
            default: null,
        },
        maxRate: {
            default: null,
        },
        noPersonas:{
            default: 10,
        }
    },
}
</script>
