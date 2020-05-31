<template>
  <v-dialog v-model="dialog" width="500">
    <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>
          メモを新規登録する（{{date}}）
        </v-card-title>

        <!-- <v-card-text>
          {{ text }}
        </v-card-text> -->
        <v-form>
            <v-container>
              <v-text-field
              v-model="title"
              :rules="titleRules"
              :counter="20"
              label="Title"
              required
            ></v-text-field>
            <v-textarea
              v-model="content"
              name="Memo"
              label="content"
              :counter="400"
              hint="Hint text"
            ></v-textarea>
            </v-container>
        </v-form>
        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            @click="register"
            
          >
            Register
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script>
export default {
  props:["text","date"],
  data() {
    return {
      dialog: false,
      title: '',
      content: '',
      titleRules: [
        v => !!v || 'Title is required',
        v => v.length <= 20 || 'Title must be less than 20 characters',
      ],
    };
  },
  methods: {
    open() {
      this.dialog = true;
    },
    close() {
      this.dialog = false;
    },
    register(){
       axios.post('/sample_laravelapp/public/api/memo', {
            title: this.title,
            content: this.content,
            date: this.date,
          }, {
            headers: {
              "Content-Type": "application/json",
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then(
          response => {
              this.new_data = ["aaa","bbb"];//response.data;
              this.dialog = false;
              this.$emit('register');
              // this.$emit();
              // console.log(this.$parent.);
              // this.$emit('resister', this.new_data)
              // console.log("success");
              // sessionStorage.setItem('tmp', JSON.stringify(this.templates));
          });
    },
    update(){
       axios.post('/sample_laravelapp/public/api/memo', {
            title: this.title,
            content: this.content,
            date: this.date,
          }, {
            headers: {
              "Content-Type": "application/json",
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then(
          response => {
              this.new_data = ["aaa","bbb"];//response.data;
              this.dialog = false;
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
