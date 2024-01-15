<template>
    <v-list>
        <v-list-item
            prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
            :title="$page.props.auth.user.name"
            :subtitle="$page.props.auth.user.email"
        />
    </v-list>

    <v-divider />

    <v-list density="compact" nav>
        <v-list-item
            prepend-icon="mdi-home"
            title="Home"
            value="home"
        ></v-list-item>

        <v-list-group value="Sales">
            <template v-slot:activator="{ props }">
                <v-list-item
                    v-bind="props"
                    prepend-icon="mdi-currency-inr"
                    title="Sales"
                ></v-list-item>
            </template>

            <v-list-item title="Order" value="order" />
            <v-list-item title="Invoice" value="invoice" />
            <v-list-item title="Shipment" value="shipment" />
            <v-list-item title="Refund" value="Refund" />
        </v-list-group>
        <v-list-group value="Catalog">
            <template v-slot:activator="{ props }">
                <v-list-item
                    v-bind="props"
                    prepend-icon="mdi-package-variant-closed"
                    title="Catalog"
                ></v-list-item>
            </template>

            <v-list-item title="Categories" value="categories"></v-list-item>
            <v-list-item title="Products" value="products"></v-list-item>
        </v-list-group>
        <v-list-item
            prepend-icon="mdi-account-multiple"
            title="Customers"
            value="customers"
        ></v-list-item>
        <v-list-item
            prepend-icon="mdi-arrow-u-down-left"
            title="Return Management"
            value="return"
        />
        <v-list-group value="Blog">
            <template v-slot:activator="{ props }">
                <v-list-item
                    v-bind="props"
                    prepend-icon="mdi-post-lamp"
                    title="Blog"
                ></v-list-item>
            </template>

            <v-list-item title="Categories" value="categories"></v-list-item>
            <v-list-item title="Posts" value="posts"></v-list-item>
            <v-list-item title="Comments" value="comments"></v-list-item>
        </v-list-group>
        <v-list-item
            prepend-icon="mdi-cogs"
            title="Settings"
            value="settings"
        />
        <v-list-group value="System">
            <template v-slot:activator="{ props }">
                <v-list-item
                    v-bind="props"
                    prepend-icon="mdi-store-cog"
                    title="System"
                ></v-list-item>
            </template>

            <v-list-item title="Admins" value="admins"></v-list-item>
            <v-list-item title="Permissions" value="permissions"></v-list-item>
            <v-list-item title="Activity" value="activity"></v-list-item>
        </v-list-group>
    </v-list>
</template>
