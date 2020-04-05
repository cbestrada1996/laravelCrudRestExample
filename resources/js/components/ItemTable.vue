<template>
    <a-table :style="{backgroundColor: '#fff'}" :columns="columns" :dataSource="items">
    <a slot="name" slot-scope="text">{{text}}</a>
    <span slot="customTitle">Item</span>
    <span slot="price" slot-scope="price">
        {{"$"+price}}
    </span>
    <span slot="action" slot-scope="text, record">
        <a-button type="primary" v-on:click="onClickSee(record)">See</a-button>
        <a-divider type="vertical" />
        <a-button type="default" v-on:click="onClickEdit(record)">Edit</a-button>
        <a-divider type="vertical" />
        <a-button type="danger" v-on:click="onClickDelete(record)">Delete</a-button>
    </span>
  </a-table>
</template>

<script>
import ItemRepository from "../repositories/ItemRepository"

const columns = [ 
  {
    dataIndex: 'name',
    key: 'name',
    slots: { title: 'customTitle' },
    scopedSlots: { customRender: 'name' },
  },
  {
    title: 'Description',
    dataIndex: 'description',
    width: "60%",
    key: 'description',
  },
  {
    title: 'Price',
    dataIndex: 'price',
    scopedSlots: { customRender: 'price' },
    key: 'price',
  },
  {
    title: 'Action',
    key: 'action',
    scopedSlots: { customRender: 'action' },
  }
];

export default {
    data() {
      return {
        columns: columns,
        items: []
      };
    },
    created() {
      this.getItems();
    },
    methods: {
      getItems: async function() {
        const { data } = await ItemRepository.get();
        this.items = data.items;
      },
      deleteItem: async function(id) {
        try{
          const { item } = await ItemRepository.delete(id);
         
          const items = [...this.items];
          this.items = items.filter(item => item.key !== id);
        }catch(error) {

        }
      
      },
      onClickSee: function(record) {
        this.$emit('onSeeItem', record)
      },
      onClickEdit: function(record) {
        this.$emit('onEditItem', record)
      },
      onClickDelete: function(record) {
        this.deleteItem(record.id)
      },
      addItem: function(record) {
        var items = this.items;
        items.unshift(record);
        this.items = items;
      },
      updateItem: function(record) {
          console.log(record)
          const newData = [...this.items];
          const target = newData.filter(item => item.key === record.key)[0];
          if (target) {
            target.name = record.name;
            target.description = record.description;
            target.price = record.price;
            target.image = record.image;
            this.data = newData;
          }
      }
    }
}
</script>

<style>

</style>