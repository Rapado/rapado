<template>
    <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container w-11/12 md:w-4/12 lg:w-3/12 rounded-lg shadow-2xl opacity-95 bg-white mx-auto p-3">

              <div class="modal-header">
                <slot name="header">
                  default header
                </slot>
              </div>

              <div class="modal-body">
                <slot name="body">
                  default body
                </slot>
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  <secondary-button class="w-full mt-2" @click="$emit('close')">
                    Cerrar
                  </secondary-button>
                </slot>
              </div>
            </div>
          </div>
        </div>
    </transition>
</template>

<script>
    import SecondaryButton from '@/Components/ButtonSecondary'

    export default {
        props: ['modelValue', 'options'],

        emits: ['update:modelValue'],

        components: {SecondaryButton},

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        },
    }
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.4s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  transition: all 0.3s ease;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
