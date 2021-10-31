<template>
    <div>
      <v-app>
        <v-app-bar   app >
            <v-toolbar-title>Tomotter</v-toolbar-title>
            <v-spacer></v-spacer>
              
                    <v-btn  outlined to='/tomotter/login'>
                        Login
                    </v-btn>
        </v-app-bar>
         <v-main>
           <router-view></router-view>
         </v-main>
         
      </v-app>
    </div>
</template>
