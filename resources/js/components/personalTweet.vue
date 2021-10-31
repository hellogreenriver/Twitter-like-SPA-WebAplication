<template>
  <div>
    <v-app>
    <v-container >
            <v-card v-for="tweet in reverseItems" :key="tweet.id">
                <v-list>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <strong>{{ tweet.name }}</strong>@{{tweet.created_at}}
                                </v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ tweet.comment }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-action>
                              <div v-if="deleteShow === true">
                                <v-btn icon  @click="Delete(tweet.id)">
                                    <v-icon >mdi-delete</v-icon>
                                </v-btn>
                              </div>
                                
                            </v-list-item-action>
                        </v-list-item>
                   
                </v-list>
               
            </v-card>
         
          <v-footer app color="transparent" height="72" inset > 
            <div  class="mx-auto">
              <v-form  >
                <v-text-field
                    background-color="grey lighten-1"
                    flat
                    hide-details
                    rounded
                    dense
                    solo
                    v-model="comment"
                    clearable
                    placeholder="Tweet content..."
                >
                　<template　v-slot:append-outer>
                  　<v-btn @click="addTweet" @keyup.enter="doTweet">Tweet</v-btn>
                　</template>
                </v-text-field>
                
              </v-form>
            </div>
        </v-footer>
     </v-container >
     </v-app>
     </div>
</template>

<script>
export default {
  data() {
    return {
      message: "",
      tweets: [],
      comment: "",
      snackbar: true,
    };
  },

  created: function() {
    this.getTimeline();
    this.checkExpiration();
    },

  methods: {
      getTimeline() {
      axios
        .get("/api/individual")
        .then(response => {
          this.tweets = response.data.data;
          console.log(response.data)
        })
        .catch(error => {
          this.message = error;
          console.log(this.message);
        });
    },
    addTweet() {
      axios
          .post("/api/tweet", {  
          comment: this.comment,
          person_id: this.user.id,
          name: this.user.name,
        })
        .then(response => {
                this.getTimeline();
                this.comment = "";
                console.log(response.data);
            })
        .catch(erorr => {
          this.message = erorr;
          console.log(this.message);
        });
    },
    Delete(id) {
            axios
                .delete("/api/delete/" + id)
                .then(response => {
                    this.getTimeline();
                })
                .catch(error => {
                    this.message = error;
                    console.log(this.message);
                });
        },

    checkExpiration(){
          var localstrageTime = JSON.parse(localStorage.getItem("auth")).timestamp;
          if(localstrageTime && localstrageTime!=undefined){
            var timeLimit = this.$store.getters.getTimeLimit;
            var now = new Date().getTime();
            var periodTime = (now-localstrageTime)/1000;
            if(periodTime > timeLimit){
              localStorage.removeItem('auth');
              console.log("localStrage(auth) was deleted")
              this.$store.dispatch('resetUser')
              this.$store.dispatch('setSnackbar', true)
              this.$router.push('/tomotter').catch(err => {});

              }
            if(!localStorage.getItem('auth')){
              this.$store.dispatch('resetUser')
              this.$store.dispatch('setSnackbar', true)
              this.$router.push('/tomotter').catch(err => {});
            }
          }
         },
    
    },
    computed: {
      deleteShow(){
        return this.$store.getters.getShow;
      },
      user(){
        return this.$store.getters.getUser;
      },
      reverseItems() {
        return this.tweets.slice().reverse();
      },
    },
}


</script>



