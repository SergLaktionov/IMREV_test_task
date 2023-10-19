<template>
    <AppLayout title="Companies">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ `${form.id ? 'Edit' : 'Create'} company data` }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div>
                            <InputLabel for="foundation_year" value="Foundation" />
                            <TextInput
                                id="foundation_year"
                                v-model="form.foundation_year"
                                type="date"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.foundation_year" />
                        </div>
                        <div>
                            <InputLabel for="description" value="Description" />
                            <TextInput
                                id="description"
                                v-model="form.description"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-x-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </PrimaryButton>
                            <Link :href="route('companies.index')">
                                <SecondaryButton>
                                    Cancel
                                </SecondaryButton>
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    company: Object,
});

const form = useForm({
    id: props.company?.id || null,
    name: props.company?.name || '',
    email: props.company?.email || '',
    foundation_year: props.company?.foundation_year || null,
    description: props.company?.description || '',
});

function submit () {
    if (form.id) {
        form.put(route('companies.update', form.id))
    } else {
        form.post(route('companies.store'))
    }
};
</script>
