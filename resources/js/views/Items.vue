<template>
  <a-layout theme="light">
    <ItemView ref="itemView" />
    <ItemForm v-on:onNewItem="onNewItem" v-on:onUpdateItem="onUpdateItem" ref="itemForm" />
    <a-layout-header :style="{background: '#fff'}" theme="light" > 
      <a-button type="primary" v-on:click="onCreateNewItem">Create new Item</a-button>
    </a-layout-header>
    <a-layout-content>
        <ItemTable v-on:onSeeItem="onSeeItem" v-on:onEditItem="onEditItem" ref="itemTable"/>
    </a-layout-content>
    <a-layout-footer>
    </a-layout-footer>  
  </a-layout>
</template>
<script>
import ItemTable from '../components/ItemTable'
import ItemView from '../components/ItemView'
import ItemForm from '../components/ItemForm'

export default {
  components: {
    ItemTable,
    ItemView,
    ItemForm
  },
  methods: {
    onSeeItem: function(record) {
      this.$refs.itemView.openDrawer(record.id)
    },
    onEditItem: function(record) {
      this.$refs.itemForm.openDrawer(record)
    },
    onCreateNewItem: function() {
      this.$refs.itemForm.openDrawer()
    },
    onNewItem: function(record) {
      this.$refs.itemTable.addItem(record)
    },
    onUpdateItem: function(record) {
      this.$refs.itemTable.updateItem(record)
    }
  }
}
</script>
<style scoped>
</style>