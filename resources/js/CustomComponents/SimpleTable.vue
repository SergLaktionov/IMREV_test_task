<template>
    <table class="table w-full">
        <thead>
            <tr>
                <th v-for="(name, field_name) in fields" :key="field_name" class="text-left">
                    {{ name }}
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in data" :key="item.id">
                <td v-for="(name, field_name) in fields" :key="`${item.id}_${field_name}`">
                    <Link :href="route(`${resource}.show`, item.id)">
                        {{ item[field_name] }}
                    </Link>
                </td>
                <td class="text-right flex gap-x-4">
                    <Link v-if="withDetails" :href="route(`${resource}.show`, item.id)">
                        <SecondaryButton>
                            Details
                        </SecondaryButton>
                    </Link>
                    <slot :item="item"></slot>
                </td>
            </tr>
            <tr v-if="!data.length">
                <td :colspan="Object.keys(fields).length + 1" class="text-center py-8">No records defined</td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    data: Array,
    fields: Object,
    resource: String,
    withDetails: {
        type: Boolean,
        default: true,
    },
});
</script>