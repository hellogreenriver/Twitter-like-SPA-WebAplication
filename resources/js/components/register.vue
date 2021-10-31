<template>
    <v-app id="inspire">
        <v-main>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="4">
                        <v-card class="elevation-12" :loading="isLoading">
                            <v-toolbar color="#e0e0e0" dark flat>
                                <v-toolbar-title class="grey--text text--darken-1">登録フォーム</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-form ref="form">
                                    <v-text-field
                                        label="Name"
                                        prepend-icon="mdi-account"
                                        type="text"
                                        v-model="name"
                                        :error-messages="errors.name"
                                    ></v-text-field>

                                    <v-text-field
                                        label="Email"
                                        prepend-icon="mdi-email"
                                        type="text"
                                        v-model="email"
                                        :error-messages="errors.email"
                                    ></v-text-field>
                                    <v-text-field
                                        label="Password"
                                        prepend-icon="mdi-lock"
                                        type="password"
                                        v-model="password"
                                        :error-messages="errors.passsword"
                                    ></v-text-field>
                                    <v-text-field
                                        label="Password confirmation"
                                        prepend-icon="mdi-lock-question"
                                        type="password"
                                        v-model="password_confirmation"
                                        :error-messages="
                                            errors.password_confirmation
                                        "
                                    ></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                
                                <router-link to="/tomotter/login" class="pull-left"
                                    >Go back to login</router-link
                                >
                                <div class="flex-grow-1"></div>
                                <v-btn color="#e0e0e0" @click="doRegister" class="pull-right" 
                                    >Sign up</v-btn
                                >
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <v-snackbar v-model="snackbar" timeout="-1" >
            Registerd!
            <template v-slot:action="{ attrs }">
                <v-btn
                    color="pink"
                    text
                    v-bind="attrs"
                    @click="goLogin"
                >
                    Lets login!
                </v-btn>
            </template>
        </v-snackbar>
    </v-app>
</template>
<script>
export default {
    data() {
        return {
            isLoading: false,
            snackbar: false,
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            errors: {},
        };
    },
    methods: {
        doRegister() {
            this.isLoading = 'red';
            axios
                .post("/api/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                .then(response => {
                    console.log(response.data);
                     this.snackbar = true;
                     this.$refs.form.reset();
                     this.$refs.form.resetValidation();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                })
                .finally(() => {
                    this.isLoading = false;
                })
        },
        goLogin(){
            this.snackbar = false;
            setTimeout(() => {
                this.$router.push('/tomotter/login')
            }, 300);
        }
    }
};
</script>
