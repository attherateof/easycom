<script setup>
import { useForm } from "@inertiajs/vue3";
import { useDate } from "vuetify";

import FormContainer from "@/admin/Components/Form/Container.vue";
import Loader from "@/admin/Components/Loader.vue";

const date = useDate();
const form = useForm({
    is_active: true,
    first_name: "",
    middle_name: "",
    last_name: "",
    email: "",
    phone: "",
    dob: date.date(),
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        dob: date.toISO(data.dob),
    })).post(route("admin.customer.save"), {
        onFinish: () => form.reset(),
    });
};
</script>
<template>
    <FormContainer
        title="Add new Customer"
        back-route="admin.customer.list"
        @submit.prevent="submit"
    >
        <v-container fluid>
            <v-row>
                <v-col cols="3" class="d-none d-sm-flex">
                    <v-list-subheader> Is Active? </v-list-subheader>
                </v-col>

                <v-col cols="9">
                    <v-switch
                        label="Yes"
                        color="purple-accent-4"
                        v-model="form.is_active"
                    ></v-switch>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="3" class="d-none d-sm-flex">
                    <v-list-subheader> First Name </v-list-subheader>
                </v-col>

                <v-col cols="9">
                    <v-text-field
                        color="purple-accent-4"
                        label="First Name"
                        placeholder="Customer's first name"
                        variant="outlined"
                        clearable
                        required
                        v-model="form.first_name"
                    />
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="3" class="d-none d-sm-flex">
                    <v-list-subheader> Middle Name </v-list-subheader>
                </v-col>

                <v-col cols="9">
                    <v-text-field
                        color="purple-accent-4"
                        label="Middle Name"
                        placeholder="Customer's middle name"
                        variant="outlined"
                        clearable
                        v-model="form.middle_name"
                    />
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="3" class="d-none d-sm-flex">
                    <v-list-subheader> Last Name </v-list-subheader>
                </v-col>

                <v-col cols="9">
                    <v-text-field
                        color="purple-accent-4"
                        label="Last Name"
                        placeholder="Customer's last name"
                        variant="outlined"
                        clearable
                        required
                        v-model="form.last_name"
                    />
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="3" class="d-none d-sm-flex">
                    <v-list-subheader> Email </v-list-subheader>
                </v-col>

                <v-col cols="9">
                    <v-text-field
                        color="purple-accent-4"
                        label="Email"
                        placeholder="Customer's email address"
                        variant="outlined"
                        clearable
                        required
                        v-model="form.email"
                    />
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="3" class="d-none d-sm-flex">
                    <v-list-subheader> Phone </v-list-subheader>
                </v-col>

                <v-col cols="9">
                    <v-text-field
                        color="purple-accent-4"
                        label="Phone"
                        placeholder="Customer's phone number"
                        variant="outlined"
                        clearable
                        v-model="form.phone"
                    />
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="3" class="d-none d-sm-flex">
                    <v-list-subheader> Date of birth </v-list-subheader>
                </v-col>

                <v-col cols="9">
                    <v-date-picker
                        show-adjacent-months
                        v-model="form.dob"
                    ></v-date-picker>
                </v-col>
            </v-row>
        </v-container>

        <template v-slot:action>
            <v-btn color="purple-accent-4" variant="flat" type="submit">
                Submit
            </v-btn>
            <Loader :show="form.processing" />
        </template>
    </FormContainer>
</template>
