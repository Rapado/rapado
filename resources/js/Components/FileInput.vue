<template>
    <span>
        <input class="input-file" type="file" name="mi-archivo" :v-model="modelValue" @input="$emit('update:modelValue', $event.target.files[0])" ref="input">
    </span>
    <div class="label-file flex space-x-3 bg-accent hover:bg-accent-dark rounded-md">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/></svg>
        <label class="" for="mi-archivo" v-text="buttonText" style="cursor: pointer;"/>
    </div>
</template>

<script>
    import BreezeLabel from '@/Components/Label'

    export default {
        components: {
            BreezeLabel,
        },

        props: ['modelValue', 'fileLabel'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        },

        computed: {
            buttonText: function(){
                return this.modelValue == null ? this.fileLabel : this.modelValue.name;
            }
        },

        watch: {
            modelValue: function(){
                console.log(typeof(this.modelValue));
            }
        }


    }
</script>

<style scoped>

.input-file {
    width: auto;
    height: auto;
    /* height: 0.1px; */
    opacity: 0;
    overflow: hidden;
    position: fixed;
    cursor: pointer;
    /* z-index: -1; */
 }

.label-file {
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    /* background-color: #106BA0; */
    transition: all .5s;
    cursor: pointer;
    padding: 9px 20px !important;
    text-transform: uppercase;
    width: auto;
    text-align: center;
 }
</style>

