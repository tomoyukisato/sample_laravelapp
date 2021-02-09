<template>
  <v-dialog v-model="detail_dialog" width="500">
    <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>
          メモ詳細（{{date}}）
        </v-card-title>

        <!-- <v-card-text>
          {{ text }}
        </v-card-text> -->
        <v-form>
            <v-container>
                <v-text-field
                v-model="form.title"
                :rules="titleRules"
                :counter="20"
                label="メニュー"
                disabled 
              ></v-text-field>
              <v-textarea
                v-model="form.content"
                name="Memo"
                label="詳細"
                :counter="400"
                disabled
              ></v-textarea>
              <v-row>
              <v-col cols="6" sm="4" v-for="(image,index) in form.image" :key="index">
              <v-img class="grey lighten-2" :src= "'/daily_menu_app/public/storage/'+image" ></v-img>
              </v-col>
              
              </v-row>
            </v-container>
        </v-form>
        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            @click="changeUpdate"
            
          >
            更新する
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script>
export default {
  props:["date","image"],
  data() {
    return {
      detail_dialog: false,

      form:{
        id: "",
        title: "",
        content: "",
        image:[],
      },
      // selected_event: this.text,
      titleRules: [
        v => !!v || 'Title is required',
        v => v.length <= 20 || 'Title must be less than 20 characters',
      ],
    };
  },
  created(){
    console.log("eee");
    console.log(this.text);
  },
  watch:{
    'detail_dialog': function() {
      if(this.detail_dialog === false){
        // this.close();
        this.$emit('reset');
      }
      console.log(this.detail_dialog);
    }
  },
  methods: {
    open(id_data, text_data, content_data,image_data) {

      this.detail_dialog = true;
      this.form.id = id_data === undefined ? "" : id_data;
      this.form.title = text_data === undefined ? "" : text_data;
      this.form.content = content_data === undefined ? "" : content_data;
      this.form.image = this.$props.image === undefined ? "" : this.$props.image;
      console.log("open");
      console.log(this.form);
    },
    close(){
      this.detail_dialog = false;
      // this.form.id = '';
      // this.form.title =  '';
      // this.form.content = '';
      // this.form.image =  '';
    },
    changeUpdate() {
      this.$emit("update",this.form);
      
    },
    register(){
       axios.post('/daily_menu_app/public/api/memo', {
            title: this.form.title,
            content: this.form.content,
            date: this.date,
          }, {
            headers: {
              "Content-Type": "application/json",
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then(
          response => {
              this.new_data = ["aaa","bbb"];//response.data;
              this.detail_dialog = false;
              this.$emit('register');
              // this.$emit();
              // console.log(this.$parent.);
              // this.$emit('resister', this.new_data)
              // console.log("success");
              // sessionStorage.setItem('tmp', JSON.stringify(this.templates));
          });
    },
    update(){
       axios.post('/daily_menu_app/public/api/memo', {
            title: this.form.title,
            content: this.form.content,
            date: this.date,
          }, {
            headers: {
              "Content-Type": "application/json",
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then(
          response => {
              this.new_data = ["aaa","bbb"];//response.data;
              this.detail_dialog = false;
              this.$emit('udpate');
              // this.$emit();
              // console.log(this.$parent.);
              // this.$emit('resister', this.new_data)
              // console.log("success");
              // sessionStorage.setItem('tmp', JSON.stringify(this.templates));
          });
    }

  }
}
</script>
