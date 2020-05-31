<template>
<v-dialog v-model="dialog" width="80%">
    <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>
            {{ header }}
        </v-card-title>
        <v-list three-line>
        <template v-for="(item, index) in items">
            <!-- <v-subheader
            v-text="header"
            ></v-subheader> -->

        
            <v-list-item
            @click=""
            >
            <!-- <v-list-item-avatar>
                <v-img :src="item.avatar"></v-img>
            </v-list-item-avatar> -->
                <v-list-item-icon>
                    <v-icon large color="green darken-2">star</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title v-html="item.title"></v-list-item-title>
                    <v-list-item-subtitle v-html="item.content"></v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
            <v-divider
            :inset="true"
            ></v-divider>
        </template>
        </v-list>
    </v-card>
</v-dialog>
</template>

<script>
  export default {

    data: () => ({
        header: 'メモ',
        items: [],
        dialog :true,
        // {
        //   title: 'Brunch this weekend?',
        //   content: "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
        // },
        // { divider: true, inset: true },
        // {
        //   title: 'Summer BBQ <span class="grey--text text--lighten-1">4</span>',
        //   content: "<span class='text--primary'>to Alex, Scott, Jennifer</span> &mdash; Wish I could come, but I'm out of town this weekend.",
        // },
        // { divider: true, inset: true },
        // {
        //   avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
        //   title: 'Oui oui',
        //   content: "<span class='text--primary'>Sandra Adams</span> &mdash; Do you have Paris recommendations? Have you ever been?",
        // },
        // { divider: true, inset: true },
        // {
        //   avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
        //   title: 'Birthday gift',
        //   content: "<span class='text--primary'>Trevor Hansen</span> &mdash; Have any ideas about what we should get Heidi for her birthday?",
        // },
        // { divider: true, inset: true },
        // {
        //   avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
        //   title: 'Recipe to try',
        //   content: "<span class='text--primary'>Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.",
        // },
    //   ],
    }),
    created:function(){
            this.getSchedule();
    },
    methods: {
        getSchedule(){
            axios.get('/sample_laravelapp/public/api/memo').then(
            response => {
                this.items = response.data;
            })
        },
    }
  }
</script>