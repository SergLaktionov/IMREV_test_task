<template>
    <AppLayout title="Companies">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
                Companies
                <Link :href="route('companies.create')">
                    <SecondaryButton>
                        Add new
                    </SecondaryButton>
                </Link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <SimpleTable
                        :data="companies.data"
                        resource="companies"
                        :fields="{
                            name: 'Name',
                            email: 'Email',
                            foundation_year: 'Foundation',
                        }"
                    />
                    <Pagination :links="companies.links" class="mt-8"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/CustomComponents/Pagination.vue';
import SimpleTable from '@/CustomComponents/SimpleTable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    companies: Array,
});

</script>
