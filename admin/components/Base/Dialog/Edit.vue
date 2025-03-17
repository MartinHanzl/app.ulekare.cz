<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';

const open = defineModel('open', { type: Boolean, default: false });
const item = defineModel('item', { type: Object });
const props = defineProps({
	name: {
		type: String,
		required: true,
	},
});

const emit = defineEmits(['edit-item']);
</script>

<template>
	<TransitionRoot
		as="template"
		:show="open"
	>
		<Dialog
			class="relative z-10"
		>
			<TransitionChild
				as="template"
				enter="ease-out duration-300"
				enter-from="opacity-0"
				enter-to="opacity-100"
				leave="ease-in duration-200"
				leave-from="opacity-100"
				leave-to="opacity-0"
			>
				<div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
			</TransitionChild>

			<div class="fixed inset-0 z-10 w-screen overflow-y-auto">
				<div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
					<TransitionChild
						as="template"
						enter="ease-out duration-300"
						enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
						enter-to="opacity-100 translate-y-0 sm:scale-100"
						leave="ease-in duration-200"
						leave-from="opacity-100 translate-y-0 sm:scale-100"
						leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					>
						<DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
							<div class="sm:flex sm:items-start">
								<div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
									<ExclamationTriangleIcon
										class="size-6 text-red-600"
										aria-hidden="true"
									/>
								</div>
								<div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
									<DialogTitle
										as="h3"
										class="text-base font-semibold text-gray-900"
									>
										{{ item.id !== 0 ? 'Upravit poznámku' : 'Vytvořit poznámku' }}
									</DialogTitle>
									<div class="mt-6 grid grid-cols-1 gap-6">
										<div class="col-span-full">
											<label
												for="name"
												class="block text-sm/6 font-medium text-gray-900"
											>Název</label>
											<div class="mt-2">
												<input
													id="name"
													v-model="item.name"
													type="text"
													name="name"
													class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
												>
											</div>
										</div>
										<div class="col-span-full">
											<label
												for="content"
												class="block text-sm/6 font-medium text-gray-900"
											>Poznámka</label>
											<div class="mt-2">
												<textarea
													id="content"
													v-model="item.content"
													type="text"
													name="content"
													rows="4"
													class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
												/>
											</div>
										</div>
										<div class="col-span-full">
											<label
												for="name"
												class="block text-sm/6 font-medium text-gray-900"
											>Název</label>
											<div class="mt-2">
												<select
													id="name"
													v-model="item.priority"
													type="text"
													name="name"
													class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
												>
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
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mt-8 sm:mt-4 sm:flex sm:flex-row-reverse">
								<button
									type="button"
									class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
									@click="emit('edit-item', item);open = false"
								>
									Uložit
								</button>
								<button
									ref="cancelButtonRef"
									type="button"
									class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
									@click="open = false"
								>
									Zrušit
								</button>
							</div>
						</DialogPanel>
					</TransitionChild>
				</div>
			</div>
		</Dialog>
	</TransitionRoot>
</template>
