<template>
    <v-card title="Customer" subtitle="Customer detail informations">
        <v-list nav density="compact">
            <v-list-item title="Account" value="account" @click="$inertia.get(route('admin.customer.add'))"/>
            <v-list-item title="Addresses" value="addresses" />
            <v-list-item title="Shopping Cart" value="shopping_cart" />
            <v-list-item title="Order List" value="order_list" />
            <v-list-item title="Returns" value="returns" />
        </v-list>
    </v-card>
</template>
