<template>
    <AppLayout title="Clients">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ `${client.name} ${client.surname}` }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <div class="flex flex-col">
                        <div class="flex">
                            <div class="w-40 font-bold">Name</div>
                            <div>{{ client.name }}</div>
                        </div>
                        <div class="flex row">
                            <div class="w-40 font-bold">Surname</div>
                            <div>{{ client.surname }}</div>
                        </div>
                        <div class="flex row">
                            <div class="w-40 font-bold">Email</div>
                            <div>{{ client.email }}</div>
                        </div>
                        <div class="flex row font-bold">
                            <div class="w-40">List of companies</div>
                        </div>
                    </div>

                    <SimpleTable
                        :data="client.companies"
                        resource="companies"
                        :fields="{
                            name: 'Name',
                            email: 'Email',
                            foundation_year: 'Foundation',
                        }"
                    />

                    <div class="flex justify-end gap-x-4 mt-8">
                        <Link :href="route('clients.edit', client.id)">
                            <SecondaryButton type="button">
                                Edit
                            </SecondaryButton>
                        </Link>
                        <DangerButton @click="deleteClient">
                            Delete
                        </DangerButton>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SimpleTable from '@/CustomComponents/SimpleTable.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    client: Object,
});

const form = useForm({});

function deleteClient() {
    form.delete(route('clients.destroy', props.client.id))
}

</script>
