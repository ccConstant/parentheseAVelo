<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});

const emit = defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        :value="modelValue"
        @input="updateValue"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        ref="input"
    />
</template>
