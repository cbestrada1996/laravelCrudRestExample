<template>
   <a-drawer
      :title="title"
      placement="right"
      width="40%"
      :closable="false"
      @close="onClose"
      :visible="visible" 
    >
        <a-form :layout="formLayout" :form="form" :label-col="{ span: 5 }" :wrapper-col="{ span: 12 }" @submit="handleSubmit">
            <a-modal :footer="null" v-model="modalVisible" @ok="handleOkError">
                <p :style="{fontSize: '2em'}"><a-icon type="close-circle" theme="twoTone" twoToneColor="#ff0000" /> Form Error </p>
                <p v-html="errorMessage"></p>
            </a-modal>
            <a-form-item label="Name">
                <a-input
                    v-decorator="['name', { initialValue: name, rules: [{ required: true, message: 'Please input the name!' }] }]"
                />
            </a-form-item>
            <a-form-item label="Description">
                <a-textarea
                    :autoSize="{ minRows: 3}"
                    v-decorator="['description', { initialValue: description, rules: [{ required: true, message: 'Please input the description!' }] }]"
                />
            </a-form-item>
            <a-form-item label="Price">
                 <a-input-number
                    :style="{width: '50%'}"
                    :formatter="value => `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                    :parser="value => value.replace(/\$\s?|(,*)/g, '')"
                    v-decorator="['price', { initialValue: price, rules: [{ required: true, message: 'Please input the price!' }] }]"
                    />
            </a-form-item>
              <a-form-item label="Image">
                <a-upload
                    listType="picture-card"
                    :showUploadList="false"
                    :beforeUpload="beforeUpload"
                    v-decorator="['image', { initialValue: [imageUrl],rules: [{ required: true, message: 'Please upload an image!' }] }]"
                >
                    <img :style="{width: '60px',height:'60px'}" v-if="imageUrl" :src="imageUrl" alt="avatar" />
                    <div v-else>
                    <a-icon type="plus"/>
                    <div class="ant-upload-text">Upload</div>
                    </div>
                </a-upload>
            </a-form-item>
            <a-form-item :wrapper-col="{ span: 12, offset: 5 }">
                <a-button type="primary" html-type="submit">
                    Submit
                </a-button>
            </a-form-item>
        </a-form>
    </a-drawer>
</template>
<script>
import ItemRepository from "../repositories/ItemRepository"
import { Modal } from 'ant-design-vue';

function initialState (component){
  return {
    title: "Item Form",
    item: null,
    file: null,
    id: null,
    name: "",
    description: "",
    price: "",
    visible: false,
    loading: false, 
    imageUrl: null,
    formLayout: 'vertical',
    errorMessage: null,
    modalVisible: false,
    form: component.$form.createForm(component, { name: 'coordinated' })
  }
}

export default {
    data() {
        return {
            title: "Item Form",
            item: null,
            file: null,
            id: null,
            name: "",
            description: "",
            price: "",
            visible: false,
            loading: false, 
            imageUrl: null,
            formLayout: 'vertical',
            errorMessage: null,
            modalVisible: false,
            form: this.$form.createForm(this, { name: 'coordinated' })
        }
    },
    methods: {
        onClose: function(){
           this.visible = false;
        },
        openDrawer: function(item = null) { 
            this.resetWindow();
            if(item != null){
                this.id = item.id;
                this.name = item.name;
                this.description = item.description;
                this.price = item.price
                this.imageUrl = item.image;
            }
            this.visible = true;
        }, 
        beforeUpload: function(file) {
            var reader = new FileReader();
            this.file = file;
            reader.onload = (e) => {
                this.imageUrl = e.target.result;
            };
            reader.readAsDataURL(file);

            return false;
        },
        handleSubmit: function(e) {
            e.preventDefault();
            this.form.validateFields((err, values) => {
                if (!err) {
                    console.log(values);
                    const formData = new FormData();
                    formData.append('name', values.name);
                    formData.append('description', values.description);
                    formData.append('price', values.price);
                    if(values.image.file != undefined){
                        formData.append('image', values.image.file);
                    }

                    if(this.id == null) this.createItem(formData);
                    else this.updateItem(formData);
                }
            });
        },
        onCloseAlert: function() {
             this.errorMessage = null;
        },
        handleOkError: function() {
            this.modalVisible = false;
        },
        createItem: async function(formData) {
            try {
                const { data } = await ItemRepository.create(formData);
                this.$emit('onNewItem', data)
                this.onClose();
            }catch ({response}) {
               this.handleErrors(response.data.error);
            }
        },
        updateItem: async function(formData) {
            try {
                const { data } = await ItemRepository.update(formData, this.id);
                this.$emit('onUpdateItem', data)
                this.onClose();
            }catch ({response}) {
                this.handleErrors(response.data.error);
            }
        },
        handleErrors: function(error) {
             var errorMessage = "";
                Object.keys(error).map(function(key, index) {
                    console.log(key)
                    errorMessage += key.charAt(0).toUpperCase() + key.slice(1) + "<br>";
                    error[key].forEach(element => {
                         errorMessage += '• ' + element + "<br>";
                    });

                });
                this.errorMessage = errorMessage;
                this.modalVisible = true;
        },
        resetWindow: function (){
            Object.assign(this.$data, initialState(this));
        }
        
    }
}
</script>

<style>

</style>