import React, {createContext, useState} from 'react'

export const Context = createContext()
const initialProducts = [
         {
    "id": 1,
    "label": "Vintage Leather Wallet",
    "price": 45.99,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 2,
    "label": "Wireless Bluetooth Earbuds",
    "price": 79.99,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 3,
    "label": "Organic Coffee Beans (1lb)",
    "price": 18.50,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 4,
    "label": "Stainless Steel Water Bottle",
    "price": 25.00,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 5,
    "label": "Portable Power Bank (10000mAh)",
    "price": 39.99,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 6,
    "label": "Artisan Scented Candle",
    "price": 22.00,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 7,
    "label": "Ergonomic Desk Chair",
    "price": 189.00,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 8,
    "label": "Smart Home LED Light Bulb",
    "price": 14.99,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 9,
    "label": "Travel Backpack (Waterproof)",
    "price": 85.00,
    "imgURL": "https://placehold.co/150x80"
  },
  {
    "id": 10,
    "label": "Noise-Cancelling Headphones",
    "price": 199.99,
    "imgURL": "https://placehold.co/150x80"
  }
    ]

export default function ProductProvider({children}){

    const [products, setProducts] = useState(initialProducts)
    const [currId, setCurrId] = useState(initialProducts.length+1)

    const addProduct = (product)=>{
        setProducts(prevProducts => [...prevProducts, {id:currId, ...product}])
        setCurrId(currId+1)
    }
    const deleteProduct = (id)=>{
        setProducts(products.filter(p=>p.id!==id))
    }
    const updateProduct=(id, newInfo)=>{
        setProducts(products.map((p)=>(p.id===id?{...p, ...newInfo}:p)))

    }

    return(
        <Context.Provider value={{products, addProduct, deleteProduct, updateProduct}}>
            {children}
        </Context.Provider>
    )
}