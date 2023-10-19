<template>
    <AppLayout title="Companies">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ company.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <div class="flex flex-col">
                        <div class="flex">
                            <div class="w-40 font-bold">Name</div>
                            <div>{{ company.name }}</div>
                        </div>
                        <div class="flex row">
                            <div class="w-40 font-bold">Email</div>
                            <div>{{ company.email }}</div>
                        </div>
                        <div class="flex row">
                            <div class="w-40 font-bold">Foundation</div>
                            <div>{{ company.foundation_year }}</div>
                        </div>
                        <div class="flex row">
                            <div class="min-w-[10rem] flex items-center font-bold">Description</div>
                            <div>{{ company.description }}</div>
                        </div>
                        <div class="flex row font-bold">
                            <div class="w-40">List of customers</div>
                        </div>
                    </div>

                    <SimpleTable
                        :data="company.clients"
                        resource="clients"
                        :fields="{
                            name: 'Name',
                            surname: 'Surname',
                            email: 'Email',
                        }"
                    />

                    <div class="flex justify-end gap-x-4 mt-8">
                        <Link :href="route('companies.edit', company.id)">
                            <SecondaryButton type="button">
                                Edit
                            </SecondaryButton>
                        </Link>
                        <DangerButton @click="deleteCompany">
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
    company: Object,
});

const form = useForm({});

function deleteCompany() {
    form.delete(route('companies.destroy', props.company.id))
}

</script>
