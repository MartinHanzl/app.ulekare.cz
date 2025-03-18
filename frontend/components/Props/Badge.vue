<script setup lang="ts">
const props = defineProps({
  priority: {
    type: Number,
    required: true,
  },
});
const classVar = computed(() => {
  if (props.priority === 3) {
    return 'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-red-50 text-red-700 ring-red-600/10';
  } else if (props.priority === 2) {
    return 'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-yellow-50 text-yellow-800 ring-yellow-600/20';
  } else if (props.priority === 1) {
    return 'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-green-50 text-green-700 ring-green-600/20';
  }
});

const text = computed(() => {
  if(props.priority === 3) {
    return 'Vysoká';
  } else if(props.priority === 2) {
    return 'Střední';
  } else if(props.priority === 1) {
    return 'Nízká';
  }
});
</script>

<template>
	<span :class="classVar">{{ text }}</span>
</template>
