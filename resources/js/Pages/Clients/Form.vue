<template>
    <AppLayout title="Clients">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ `${form.id ? 'Edit' : 'Create'} client data` }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <form @submit.prevent="">
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
                            <InputLabel for="surname" value="Surname" />
                            <TextInput
                                id="surname"
                                v-model="form.surname"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.surname" />
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
                            <InputLabel value="Connected companies" />
                            <SimpleTable
                                v-slot="slotProps"
                                :data="form.attachedCompanies"
                                resource="companies"
                                :withDetails="false"
                                :fields="{
                                    name: 'Name',
                                    email: 'Email',
                                    foundation_year: 'Foundation',
                                }"
                            >
                                <PrimaryButton type="button" @click="removeCompanyFromList(slotProps.item)">
                                    -
                                </PrimaryButton>
                            </SimpleTable>
                        </div>

                        <PrimaryButton v-if="!addCompanyMode" type="button" @click="addCompanyMode = true">
                            Add company
                        </PrimaryButton>
                        <template v-else>
                            <div>
                                <InputLabel for="search" value="Search companies" />
                                <div class="flex gap-x-4">
                                    <TextInput
                                        id="search"
                                        v-model="search"
                                        class="mt-1 block w-full"
                                        @keyup.prevent.enter="getListOfCompanies"
                                    />
                                    <PrimaryButton @click="getListOfCompanies">
                                        Search
                                    </PrimaryButton>
                                    <SecondaryButton @click="addCompanyMode = false">
                                        Hide
                                    </SecondaryButton>
                                </div>
                            </div>

                            <template v-if="companies">
                                <SimpleTable
                                    v-slot="slotProps"
                                    :data="companies.data"
                                    resource="companies"
                                    :withDetails="false"
                                    :fields="{
                                        name: 'Name',
                                        email: 'Email',
                                        foundation_year: 'Foundation',
                                    }"
                                >
                                    <PrimaryButton type="button" @click="addCompanyToList(slotProps.item)">
                                        +
                                    </PrimaryButton>
                                </SimpleTable>
                                <Pagination
                                    :links="companies.links"
                                    :axiosCompatible="true"
                                    class="mt-8"
                                    @loadPage="getListOfCompanies"
                                />
                            </template>
                        </template>

                        <div class="flex items-center justify-end mt-4 gap-x-4">
                            <PrimaryButton type="button" @click="submit">
                                Save
                            </PrimaryButton>
                            <Link :href="route('clients.index')">
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
import Pagination from '@/CustomComponents/Pagination.vue';
import SimpleTable from '@/CustomComponents/SimpleTable.vue';
import { Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
    client: Object,
});

const form = useForm({
    id: props.client?.id || undefined,
    name: props.client?.name || '',
    surname: props.client?.surname || '',
    email: props.client?.email || '',
    attachedCompanies: props.client?.companies || [],
});

const search = ref('')
const addCompanyMode = ref(false)
let companies = ref(false)

function submit () {
    let transformedForm = form.transform((data) => ({
            ...data,
            attachedCompanies: data.attachedCompanies.map(company => company.id),
        }))

    if (form.id) {
        transformedForm.put(route('clients.update', form.id))
    } else {
        transformedForm.post(route('clients.store'))
    }
};

function getListOfCompanies(page) {
    axios.get(route('search.companies', {
        selected: form.attachedCompanies.map(company => company.id),
        search: search.value,
        page,
    })).then(res => companies.value = res.data)
}

function removeCompanyFromList(company) {
    form.attachedCompanies = form.attachedCompanies.filter(item => item.id !== company.id)
}

function addCompanyToList(company) {
    form.attachedCompanies.push(company)
    companies.value.data = companies.value.data.filter(item => item.id !== company.id)
}
</script>
