<script setup lang="ts">
import { ref } from 'vue';
import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid';
import { ChevronDownIcon } from '@heroicons/vue/16/solid';

const route = useRoute();
const pageTitle = ref('Vytvořit poznámku');

useHead({
	title: pageTitle.value,
});
</script>

<template>
	<form>
		<div class="space-y-12">
			<div class="border-b border-gray-900/10 pb-12">
				<h2 class="text-base/7 font-semibold text-gray-900">
					{{ pageTitle }}
				</h2>

				<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
					<div class="sm:col-span-4">
						<label
							for="username"
							class="block text-sm/6 font-medium text-gray-900"
						>Název</label>
						<div class="mt-2">
							<div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
								<input
									id="username"
									type="text"
									name="username"
									class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
									placeholder="janesmith"
								>
							</div>
						</div>
					</div>

					<div class="col-span-full">
						<label
							for="about"
							class="block text-sm/6 font-medium text-gray-900"
						>Poznámka</label>
						<div class="mt-2">
							<textarea
								id="about"
								name="about"
								rows="3"
								class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
							/>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="mt-6 flex items-center justify-end gap-x-6">
			<button
				type="submit"
				class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
			>
				Uložit
			</button>
		</div>
	</form>
</template>
