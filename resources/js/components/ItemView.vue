<template>
    <a-drawer
      :title="title"
      placement="right"
      width="40%"
      :closable="false"
      @close="onClose"
      :visible="visible" 
    >
        <div v-if="item != null">
            <a-card hoverable>
                <img
                alt="example"
                :src="item.image"
                slot="cover"
                />
                <a-card-meta :title="item.name">
                <template slot="description"
                    >
                    <p>{{item.description}}</p><p>{{`Price: $${item.price}`}}</p></template
                >
                </a-card-meta>
            </a-card>
        </div>
    </a-drawer>
</template>

<script>
import ItemRepository from "../repositories/ItemRepository"

export default {
    data() {
      return {
        title: "Item View",
        item: null,
        visible: false
      };
    },
    methods: {
        onClose: function(){
            this.visible = false;
        },
        openDrawer: function(id) {
            this.visible = true;
            this.loadItem(id);
        },
        loadItem: async function(id) {
            const { data } = await ItemRepository.getItem(id);
            this.item = data;
        },
    }
}
</script>

<style>

</style>1