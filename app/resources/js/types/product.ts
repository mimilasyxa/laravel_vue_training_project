export type Product = {
    id: number;
    name: string;
    description: string;
    price: number,
    category: Category
};

export type Category = {
    id: number,
    name: string,
    description: string
}
