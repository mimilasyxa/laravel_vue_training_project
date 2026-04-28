import axios from 'axios';
import type { Product } from './types';
import {Category} from "@/types";

const apiClient = axios.create({
    baseURL: 'http://localhost:8080/api', // TODO: Заменить на чтение из .env файла
    headers: { 'Content-Type': 'application/json' },
});

export const getProducts = async (): Promise<{items: Product[], pagination: any}> => {
    const { data } = await apiClient.get('/products');
    return { items: mapProducts(data.data), pagination: data.meta }
};

const mapProducts = (data: array) => {
    return data.map((data) => {
        return {
            id: data.id,
            name: data.name,
            description: data.description,
            price: data.price,
            category: {
                id: data.category.id,
                name: data.category.name,
                description: data.category.desciption,
            } as Category
        } as Product
    })
}
