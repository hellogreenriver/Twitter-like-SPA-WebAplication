<template>
  <div>
    <v-app>
    <v-container >
        <v-row justify="center">
            <v-col cols="12" sm="6">
                <div>
                 <v-text-field
                   placeholder="Name or tweet content..."
                   solo
                   dense
                   v-model="keyword"
                   append-icon="mdi-magnify"
                   @click:append="doSearch"
                   @keyup.enter="doSearch"
                   clearable
                ></v-text-field
                >
                </div>
            </v-col>
        </v-row>
        
        <v-row>
          <v-col>
            
            <template v-if="this.search.length > 0 && this.showResult==true && this.keyword !=null">
            <v-card v-for="searchResult in search" :key="searchResult.id">
                <v-list>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>
                                     <strong>{{ searchResult.name }}</strong>@{{searchResult.created_at}}
                                </v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ searchResult.comment }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                </v-list>
            </v-card>
            </template>
            <template v-else-if="this.search.length <= 0 && this.showResult==true && this.keyword !=null">
              <p>{{ message }}</p>
                
            </template>
            
          </v-col>
        </v-row>
        
     </v-container >
     </v-app>
     </div>
</template>

<script>
export default {
  data() {
    return {
      keyword: "",
      search: [],
      message: "",
      showResult: false,
      error: ""
    };
  },
  created: function() {
    this.checkExpiration();
    },
  methods: {
    doSearch(keyword) {
      axios
        .get("/api/search/", {params: {keyword:this.keyword}} )
        .then(response => {
          this.search = response.data.data;
          console.log(this.search);
          this.showResult = true;
          if(this.search.length > 0){
            this.message = null;
          }
          else if(this.search.length <= 0){
            this.message = "Not found";
          }
        })
        .catch(error => {
          this.message = "Not found";
          this.error = error;
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
              this.$store.dispatch('resetUser')
              console.log("localStrage(auth) was deleted")
              this.$store.dispatch('setSnackbar', true)
              this.$router.push('/tomotter');
              }
            if(!localStorage.getItem('auth')){
              this.$store.dispatch('resetUser')
              this.$store.dispatch('setSnackbar', true)
              this.$router.push('/tomotter').catch(err => {});
            }
          }
         },
        },

};
</script>