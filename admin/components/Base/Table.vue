<script setup lang="ts">
const filter = defineModel('filter', {
	type: String,
	default: 1,
});
const props = defineProps({
	items: {
		type: Array,
		required: true,
		default: [] as [],
	},
	columns: {
		type: Array,
		required: true,
		default: [] as [],
	},
	query: {
		type: Object,
		required: false,
		default: null,
	},
	actions: {
		type: Array,
		required: false,
		default: [] as [],
	},
	singular: {
		type: String,
		required: false,
		default: '' as string,
	},
	plural: {
		type: String,
		required: false,
		default: '' as string,
	},
	loading: {
		type: Boolean,
		required: false,
		default: false as boolean,
	},
	error: {
		type: Boolean,
		required: false,
		default: false as boolean,
	},
});

const deleteDialog = ref({
	open: false as boolean,
	item: {} as object,
});

function activateDeleteDialog(item: object) {
	deleteDialog.value.open = true;
	deleteDialog.value.item = item;
}

const router = useRouter();
const emit = defineEmits(['edit-item', 'delete-item', 'filter-table']);
</script>

<template>
	<div class="px-4 sm:px-6 lg:px-8">
		<div class="sm:flex sm:items-center">
			<div class="sm:flex-auto">
				<h1 class="text-base font-semibold text-gray-900">
					Poznámky
				</h1>
				<p class="mt-2 text-sm text-gray-700">
					Seznam všech poznámek vč. možnosti jejich úpravy a řazení dle priority.
				</p>
			</div>
			<div class="mt-4 sm:ml-16 sm:mt-0 sm:flex gap-x-6">
				<select
					id="name"
					v-model="filter"
					type="text"
					name="name"
					class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
				>
					<option value="null">
						Vše
					</option>
          <option value="1">
						Nízká
					</option>
					<option value="2">
						Střední
					</option>
					<option value="3">
						Vysoká
					</option>
				</select>
				<button
					type="button"
					class="block rounded-md bg-primaryCustom px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-primaryLight focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primaryCustom"
					@click="emit('edit-item', { id: 0 })"
				>
					Vytvořit poznámku
				</button>
			</div>
		</div>
		<div class="mt-8 flow-root">
			<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
				<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
					<table
						v-if="!loading && !error && items.length"
						class="min-w-full divide-y divide-gray-300"
					>
						<thead>
							<tr>
								<th
									v-for="columns in columns"
									:key="columns.key"
									scope="col"
									class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
								>
									{{ columns.name }}
								</th>
								<th
									scope="col"
									class="relative py-3.5 pl-3 pr-4 sm:pr-0"
								>
									<span class="sr-only">Upravit</span>
								</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-gray-200">
							<tr
								v-for="(item, key) in items"
								:key="key"
							>
								<td
									v-for="(columns, index) in columns"
									:key="index"
									class="whitespace-nowrap py-4 px-3 text-sm font-medium text-gray-500"
								>
                  <p v-if="columns.type === 'text' || columns.type === 'number'">
                    {{ item[columns.key] ?? '-' }}
                  </p>
                  <p v-if="columns.type === 'badge'">
                    <PropsBadge :priority="item[columns.key]" />
                  </p>
								</td>
								<td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 flex gap-x-4 justify-end">
									<span
										class="text-primaryCustom hover:text-primaryCustom"
										@click="emit('edit-item', item)"
									>Upravit</span>
									<span
										class="text-danger hover:text-dangerLight"
										@click="activateDeleteDialog(item)"
									>Smazat</span>
								</td>
							</tr>
						</tbody>
					</table>
					<p
						v-else-if="!loading && !error && items.length === 0"
						class="mt-2 text-sm text-gray-700"
					>
						Nemáte žádné {{ plural.toLowerCase() }}.
					</p>
					<p
						v-else-if="!loading && error"
						class="mt-2 text-sm text-gray-700"
					>
						Při načítání dat nastala chyba.
					</p>
					<p
						v-else-if="loading && !error"
						class="mt-2 text-sm text-gray-700"
					>
						{{ plural }} se načítají
					</p>
				</div>
			</div>
		</div>
		<BaseDialogDelete
			v-model:open="deleteDialog.open"
			v-model:item="deleteDialog.item"
			:name="singular"
			@delete-item="emit('delete-item', $event)"
		/>
	</div>
</template>
