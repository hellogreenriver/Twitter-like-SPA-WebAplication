<template>
<div>
  <v-app id="inspire">
    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12" :loading="isLoading">
              <v-toolbar
                color="#e0e0e0"
                dark
                flat
              >
                <v-toolbar-title class="grey--text text--darken-1">Login form</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Email"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="email"
                    :error-messages="errors.email"
                  ></v-text-field>

                  <v-text-field
                    label="Password"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="password"
                    :error-messages="errors.password"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                  <router-link to="/tomotter/register"　class="ml-3">Sigh up</router-link>
                  <v-spacer></v-spacer>
                <div class="flex-grow-1"></div>
                <v-btn color="#e0e0e0" @click="login">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</div>
</template>
<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            errors: {},
            isLoading: false,
        };
    },
    methods: {
        login() {
            this.isLoading = 'red';
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios
                    .post("/api/login", {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        var date = new Date();
                        const now = JSON.stringify({timestamp: date.getTime()});
                        console.log(now);
                        localStorage.setItem("auth", now);
                        this.$router.push("/tomotter/personaltweet");
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        console.log(this.errors)
                    })
                    .finally(() => {
                    this.isLoading = false;

                })
            });
        },

    }
};

</script>
