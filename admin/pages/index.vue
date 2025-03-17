<script setup lang="ts">
import { ref } from 'vue';

const loading = ref(false);
const error = ref(false);

const toast = useToast();

const items = ref([]);
const query = ref({
	orderBy: 'priority' as string,
	orderWay: 'desc' as string,
	filter: null as number | null,
});

function loadItems() {
	loading.value = true;
	const client = useSanctumClient();

	client<{}>('/api/note', {
		method: 'GET',
		query: query.value,
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json',
		},
	}).then((response) => {
		items.value = response;
	}).catch(() => {
		error.value = true;
		toast.add({
			title: 'Chyba',
			description: 'Nepodařilo se načíst poznámky. Zkuste to prosím později.',
			color: 'red',
		});
	}).finally(() => {
		loading.value = false;
	});
	loading.value = false;
}

function saveItem(item) {
  console.log(item);
	loading.value = true;
	const client = useSanctumClient();

	client<{}>(item.id != 0 ? '/api/note/' + item.id : '/api/note', {
		method: 'POST',
		body: item,
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json',
		},
	}).then(() => {
		loadItems();
		toast.add({
			title: 'Uloženo',
			description: 'Poznámka byla úspěšně uložena.',
			color: 'green',
		});
	}).catch(() => {
		loading.value = false;
		error.value = true;
		toast.add({
			title: 'Chyba',
			description: 'Nepodařilo se uložit poznámku. Zkuste to prosím později.',
			color: 'red',
		});
	});
}

function deleteItem(id) {
	loading.value = true;
	const client = useSanctumClient();

	client<{}>('/api/note/' + id, {
		method: 'DELETE',
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json',
		},
	}).then(() => {
		loadItems();
		toast.add({
			title: 'Smazáno',
			description: 'Poznámka byla úspěšně smazána.',
			color: 'green',
		});
	}).catch(() => {
		loading.value = false;
		error.value = true;
		toast.add({
			title: 'Chyba',
			description: 'Nepodařilo se smazat poznámku. Zkuste to prosím později.',
			color: 'red',
		});
	});
}

const editDialog = ref({
	open: false,
	item: { id: 0, name: '', content: '', priority: 1 },
});

function activateEditDialog(item) {
	editDialog.value.open = true;
	if (item && item.id !== 0) {
		editDialog.value.item = item;
	}
	else {
		editDialog.value.item = { id: 0, name: '', content: '', priority: 1 };
	}
}

useHead({
	title: 'Poznámky',
});

watch(() => query.value, () => {
	loadItems();
}, { deep: true });

onMounted(() => {
	loadItems();
});
</script>

<template>
	<div>
		<BaseTable
			v-model:filter="query.filter"
			:items="items"
			:query="query"
			:columns="[
				{ key: 'id', name: 'ID', type: 'text', width: 80, hidden: false, sortable: true },
				{ key: 'name', name: 'Název', type: 'text', width: 80, hidden: false, sortable: true },
				{ key: 'content', name: 'Text', type: 'text', width: 80, hidden: false, sortable: true },
				{ key: 'priority', name: 'Priorita', type: 'badge', width: 80, hidden: false, sortable: true },
			]"
			:actions="[
				{ type: 'edit' },
				{ type: 'delete' },
			]"
			:loading="loading"
			:error="error"
			singular="Poznámku"
			plural="Poznámky"
			@delete-item="deleteItem"
			@edit-item="activateEditDialog"
		/>
		<BaseDialogEdit
			v-model:open="editDialog.open"
			v-model:item="editDialog.item"
			@edit-item="saveItem"
		/>
	</div>
</template>
