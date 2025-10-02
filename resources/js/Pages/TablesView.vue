<script setup>
import {
    mdiMonitorCellphone,
    mdiTableBorder,
    mdiTableOff,
    mdiGithub,
} from "@mdi/js";
import SectionMain from "@/Components/SectionMain.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import TableSampleClients from "@/Components/TableSampleClients.vue";
import CardBox from "@/Components/CardBox.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBoxComponentEmpty from "@/Components/CardBoxComponentEmpty.vue";
import CardBoxWidget from "@/Components/CardBoxWidget.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    totalUsers: Number,
});
</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiTableBorder"
                title="Tables"
                main
            >
                <!-- <BaseButton
          href="https://github.com/justboil/admin-one-vue-tailwind"
          target="_blank"
          :icon="mdiGithub"
          label="Star on GitHub"
          color="contrast"
          rounded-full
          small
        /> -->
            </SectionTitleLineWithButton>
            <!-- <NotificationBar color="info" :icon="mdiMonitorCellphone">
                <b>Responsive table.</b> Collapses on mobile
            </NotificationBar> -->

            <!-- <CardBox class="mb-6" has-table>
                <TableSampleClients checkable />
            </CardBox> -->

            <!-- <SectionTitleLineWithButton
                :icon="mdiTableOff"
                title="Empty variation"
            /> -->

            <!-- <NotificationBar color="danger" :icon="mdiTableOff">
                <b>Empty table.</b> When there's nothing to show
            </NotificationBar> -->

            <CardBox>
                <!-- <CardBoxComponentEmpty /> -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-6">
                    <Link :href="route('user.index')" class="block">
                        <CardBoxWidget
                            trend="12%"
                            trend-type="up"
                            color="text-emerald-500"
                            :icon="mdiAccountMultiple"
                            :number="totalUsers"
                            label="Users"
                    /></Link>
                    <Link :href="route('vendor.index')" class="block">
                        <CardBoxWidget
                            trend="12%"
                            trend-type="down"
                            color="text-blue-500"
                            :icon="mdiCartOutline"
                            :number="totalVendors"
                            prefix=""
                            label="Vendors"
                    /></Link>
                    <Link :href="route('service.index')" class="block">
                        <CardBoxWidget
                            trend="Overflow"
                            trend-type="alert"
                            color="text-red-500"
                            :icon="mdiChartTimelineVariant"
                            :number="totalServices"
                            suffix=""
                            label="Services"
                    /></Link>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-6">
                    <Link :href="route('event.index')" class="block">
                        <CardBoxWidget
                            trend="12%"
                            trend-type="up"
                            color="text-emerald-500"
                            :icon="mdiAccountMultiple"
                            :number="totalEvents"
                            label="Events"
                    /></Link>
                    <Link :href="route('eventtype.index')" class="block">
                        <CardBoxWidget
                            trend="12%"
                            trend-type="down"
                            color="text-blue-500"
                            :icon="mdiCartOutline"
                            :number="totalVendors"
                            prefix=""
                            label="Event Type"
                    /></Link>
                    <Link :href="route('guest.index')" class="block">
                        <CardBoxWidget
                            trend="Overflow"
                            trend-type="alert"
                            color="text-red-500"
                            :icon="mdiChartTimelineVariant"
                            :number="totalServices"
                            suffix=""
                            label="Guest"
                    /></Link>
                </div>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
