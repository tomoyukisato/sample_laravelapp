<template>
    <div>
        <v-list three-line>
                <template v-for="(item, index) in items">
                <v-list-item :key="index" @click="clickDetail(item.id)">

                        <v-list-item-icon>
                            <v-icon large color="green darken-2">star</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-html="item.title"></v-list-item-title>
                            <v-list-item-subtitle v-html="item.content"></v-list-item-subtitle>
                        </v-list-item-content>
                        
                </v-list-item>
                <v-divider :inset="inset" :key="index"></v-divider> 
                </template>
        </v-list>

    </div>
</template>




<script>
  export default {

    data: () => ({
        header: 'メモ',
        items: [],
        dialog :false,
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
            axios.get('/daily_menu_app/public/api/memo').then(
            response => {
                this.items = response.data;
            })
        },
        clickDetail(){
            // document.z
        }
    }
  }
</script>
<style>
    hr{
        margin:0px;
    }
</style>
