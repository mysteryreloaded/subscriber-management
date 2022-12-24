<template>
    <button @click="toggleModalState" class="text-white">Open modal</button>
    <modal v-if="modalOpen">
        <p>Hello, I'm a modal window.</p>
    </modal>
</template>
<script>
    import Modal from "./Modal.vue";
    import { ref } from "vue";

    export default {
        setup () {
            const modalOpen = ref(false);
            const toggleModalState = () => {
                modalOpen.value = !modalOpen.value;
            };
            return {
                modalOpen,
                toggleModalState
            }
        },
        components: {
            Modal
        }
    };
</script>
