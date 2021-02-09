<template>
  <v-dialog v-model="dialog" width="500">
    <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>
          メモを新規登録する（{{date}}）
        </v-card-title>

        <!-- <v-card-text>
          {{ text }}
        </v-card-text> -->
        <v-form
          v-if="show_form1"
        >
            <v-container>
                <v-text-field
                v-model="form.title"
                :rules="titleRules"
                :counter="20"
                label="メニュー"
                required
              ></v-text-field>
              <v-textarea
                v-model="form.content"
                name="Memo"
                label="詳細"
                :counter="400"
                hint="Hint text"
              ></v-textarea>

            </v-container>
        </v-form>
        <v-form
          enctype="multipart/form-data"
          v-if="show_form2"
          >
              <v-file-input accept="image/*" ref="files" multiple  label="画像アップロード" name="file" @change="selectedFile"></v-file-input>
              <!-- <input type="file" accept="image/*" label="画像アップロード" @change="selectedFile"></input> -->
        </v-form>
        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click="register" v-if="show_form1 && form.id == 0">
            次へ(新)

          </v-btn>
          <v-btn color="primary" @click="update" v-if="show_form1 && form.id > 0">
            次へ(編)
          </v-btn>
          <v-btn color="primary" @click="img_upload" v-if="show_form2">
            登録する
          </v-btn>
          
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script>
export default {
  props:["date"],
  data() {
    return {
      dialog: false,
      show_form1:true,
      show_form2:false,
      new_data:0,
      form:{
        id: "",
        title: "",
        content: "",
        uploadFile: '',
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
  methods: {
    selectedFile: function(e) {
        // 選択された File の情報を保存しておく
        console.log(e);
        // event.preventDefault();
        // let files = event.target.files;
        // this.uploadFile = files[0];
        this.uploadFile = e;
        // this.createImage(e);
        console.log(this.uploadFile);
    },
    open(id_data, text_data, content_data) {
      console.log('編集登録開きました。');
      console.log(id_data);
      console.log(text_data);
      console.log(content_data);
      this.dialog = true;
      this.form.id = id_data === undefined ? "" : id_data;
      this.form.title = text_data === undefined ? "" : text_data;
      this.form.content = content_data === undefined ? "" : content_data;

    },
    close() {
      this.dialog = false;
    },
    createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.uploadFile= e.target.result;
            };
            reader.readAsDataURL(file);
        },
    register(e){
      const formData = new FormData();
      // const file = new Blob(this.uploadFile, { type: 'image/png' })
      // formData.append('id', '00000001');
      // console.log(formData);
      // console.log(formData.get('id'));
      
        // e.preventDefault();
        // if(this.uploadFile){
// for (let value of formData.entries()) { 
//     console.log(value); 
// }
        //     // for( let file in this.uploadFile){
        //         // console.log(file)
      // formData.append("file", this.uploadFile[0]);
      // for( var i = 0; i < this.uploadFile.length; i++ ){

      // console.log(file)
        //     // console.log(formData.getAll("file"))
            
        // }
      let res_data = '';
       axios.post('/daily_menu_app/public/api/memo', {
            title: this.form.title,
            content: this.form.content,
            date: this.date,
            // data:formData,
          }, {
            headers: {
              "Content-Type": "application/json",
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              // 'Content-Type': 'multipart/form-data'
            }
          }).then(
          response => {
              console.log("res");
              console.log(response.data.id);
              res_data = response.data.id;
              this.show_form1 = false;
              this.show_form2 = true;
              this.new_data = response.data.id;//response.data;

              // this.$emit();
              // console.log(this.$parent.);
              // this.$emit('resister', this.new_data)
              // console.log("success");
              // sessionStorage.setItem('tmp', JSON.stringify(this.templates));
          });
          console.log("response");
          console.log(this.new_data);

    },
    img_upload(){
      const formData = new FormData();

      // let file = this.uploadFile[0];
      let files = this.uploadFile;
      files.forEach(file =>{
          formData.append('file[]', file,file.name);
      });
      console.log(formData.get('file[]'))
      console.log("ss");
      
      for (let value of formData.entries()) { 
          console.log(value); 
      }
      axios.post('/daily_menu_app/public/api/file/'+this.new_data, 
            formData,
          {
            headers: {
              // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              'Content-Type': 'multipart/form-data',
            }
          }).then(
          response => {
              console.log(response);
              this.show_form1 = true;
              this.show_form2 = false;
              this.dialog = false;
              this.$emit('register');
          });
    },
    update(){
       axios.put('/daily_menu_app/public/api/memo/'+this.form.id, {
            title: this.form.title,
            content: this.form.content,
          }, {
            headers: {
              "Content-Type": "application/json",
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then(
          response => {
            console.log(response.data);
              this.show_form1 = false;
              this.show_form2 = true;
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
