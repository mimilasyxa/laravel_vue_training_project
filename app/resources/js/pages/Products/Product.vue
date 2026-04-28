<script setup lang="ts">

import {Product} from "@/types";

defineProps<{ product: Product }>()

</script>

<template>
    <el-card style="max-width: 480px">
        <template #header>
            <div class="card-header">
                <span>Name: {{  product.name }}</span>
            </div>
        </template>
        <p class="text item">Description: {{ product.description }}</p>
        <p class="text item"><b> Price: {{ product.price }}  </b></p>
        <template #footer>
            <div class="card-footer">
                <span>Category: {{  product.category.name }}</span>
            </div>
            <p class="text item"><b> Description: {{ product.category.description }}  </b></p>
        </template>

    </el-card>
</template>

<style scoped>
</style>
