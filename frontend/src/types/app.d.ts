export type CategoryType = {
    id: number,
    name: string,
    created_at: string,
    updated_at: string,
}

export type ProductType = {
    id: number,
    name: string,
    description: string,
    image: string,
    price: string,
    categories: CategoryType[],
    created_at: string,
    updated_at: string,
}