<template>
  <v-app>
    <v-system-bar app clipped>

      <span>Tomotter</span>
      <v-spacer></v-spacer>
    </v-system-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
    >
      <v-sheet
        color="grey lighten-4"
        class="pa-4"
      >
        <div>{{user.name}}</div>
      </v-sheet>

      <v-divider></v-divider>

      <v-list>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon >mdi-account</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>
              <router-link to="/tomotter/personaltweet">Personal tweet</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon >mdi-account-group</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title >
              <router-link to="/tomotter/timeline">Timeline</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon >mdi-magnify</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>
              <router-link to="/tomotter/search">Find</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <div v-if="deleteShow === false">
      <v-list>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-delete</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title @click="setDeleteShow(true)">
              Delete tweet
　　　　　　　</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      </div>
      <div v-else>
        <v-list>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon color="red">mdi-cancel</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title @click="setDeleteShow(false)">
              Abort delete mode
　　　　　　　</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      </div>

      <v-list>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon color="red">mdi-power</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="red--text"　@click="logout">Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container
        class="py-8 px-6"
        fluid
      >
          <router-view class="personalTweet" ></router-view>       
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
export default {
     data() {
        return {
         drawer: true,
        };
    },
    created:function () {
      this.$store.dispatch("importUserInformation");
    },
    methods:{
        logout(){
            axios
                .post("/api/logout")
                .then(response => {
                    console.log(response);
                    localStorage.removeItem("auth");
                    this.$router.push("/tomotter");
                })
                .catch(error => {
                    console.log(error);
                });
            
        },
        setDeleteShow(bool){
         this.$store.dispatch('setDeleteShow',bool);
      },
    },
    computed: {
      deleteShow(){
        return this.$store.getters.getShow;
      },
      user(){
        return this.$store.getters.getUser;
      },
    },

}
</script>
<style scoped>
a {
  color: black;
  text-decoration: none;
}
.router-link-exact-active {
  color: black;
  text-decoration: none;
}
.router-link-active{
  color: black;
  text-decoration: none;
}
</style>