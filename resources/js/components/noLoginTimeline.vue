<template>
    <div>
        <v-card v-for="tweet in reverseItems" :key="tweet.id">
            <v-list>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>
                            <div class="font-weight-normal">
                            <strong>{{ tweet.name }}</strong>@{{tweet.created_at}}
                            </div>
                        </v-list-item-title>
                        <v-list-item-subtitle>
                            {{ tweet.comment }}
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-card>
        <v-snackbar v-model="this.snackbar" >
            Logged out
            <template v-slot:action="{ attrs }">
                <v-btn
                    color="pink"
                    text
                    v-bind="attrs"
                    @click="setSnackbar(false); snackbar=false"
                >
                    OK
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            message: "",
            tweets: [],
            snackbar: false,
        };
    },
    created: function() {
        this.getTimeline();
        this.constructSnackbar;
    },
    methods: {
        getTimeline() {
            axios
                .get("/api/tomotter")
                .then(response => {
                    this.tweets = response.data.data;
                    console.log(response.data);
                })
        },
        setSnackbar(bool){
            return this.$store.dispatch('setSnackbar',bool);
        },
    },
    computed: {
        reverseItems() {
        return this.tweets.slice().reverse();
        },
        constructSnackbar(){
            const snack_bar = this.$store.getters.getSnackbar;
            this.snackbar = snack_bar;
        }
    },
};
</script>