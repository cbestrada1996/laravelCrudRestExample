<template>
    <a-table :columns="columns" :dataSource="data">
    <a slot="name" slot-scope="text">{{text}}</a>
    <span slot="customTitle">Item</span>
    <span slot="price" slot-scope="price">
        {{"$"+price}}
    </span>
    <span slot="action">
        <a-button type="primary">See</a-button>
        <a-divider type="vertical" />
        <a-button type="danger">Delete</a-button>
    </span>
  </a-table>
</template>

<script>

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
    },
  ];

const data = [
    {
      key: '1',
      name: 'John Brown',
      description: 'New York No. 1 Lake Park, New York No. 1 Lake Park',
      price: 32
    },
   {
      key: '2',
      name: 'John Brown',
      description: 'New York No. 1 Lake Park, New York No. 1 Lake Park',
      price: 32
    },
    {
      key: '3',
      name: 'John Brown',
      description: 'New York No. 1 Lake Park, New York No. 1 Lake Park',
      price: 32
    },
  ];
export default {
    data() {
      return {
        columns,
        data
      };
    },
}
</script>

<style>

</style>