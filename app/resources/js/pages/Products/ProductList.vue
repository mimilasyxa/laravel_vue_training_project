<script setup lang="ts">

import { ref, onMounted, useTemplateRef} from 'vue'
import Product from "@/pages/Products/Product.vue";
import {getProducts} from "@/services/api-service";
import { useInfiniteScroll } from '@vueuse/core'

const products = ref([])
const pagination = ref([])
const loading = ref(true)
const list = useTemplateRef('list')

const getProductsList = async (cursor) => {
    try {
        const response = await getProducts(cursor)
        products.value.push(...response.items)
        pagination.value = response.pagination
        loading.value = false
    } catch (error) {
        console.error("API Error:", error)
    }
}
useInfiniteScroll(list,
    () => {
        loading.value = true;
        getProductsList(pagination.value.next_cursor)
    },
    {
        distance: 10,
        canLoadMore: () => {
            return pagination.value.next_cursor != ''
        },
    }
)

onMounted(getProductsList)

</script>
<template>
        <div class="common-layout">
            <el-container>
                <el-main>
                    <p class="text item">Products</p>
                    <div style="height: 100vh; overflow: auto;" ref="list">
                    <Product v-for="(product) in products"
                             :product="product"
                             :key="product.id">
                    </Product>
                    </div>
                    <p v-if="loading">Loading :)</p>
                </el-main>
            </el-container>
        </div>
</template>

<style scoped>
.common-layout {
    margin: auto;
    width: 35%;
}
</style>

