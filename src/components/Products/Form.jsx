import React, {useState, useRef, useEffect, useContext} from 'react'
import { Context } from './context'
import List from './list'

export default function Form(){
    const {products, addProduct, updateProduct, deleteProduct} = useContext(Context)
    const label = useRef('')
    const price = useRef(0)
    const imgURL = useRef('')
    const [idToEdit, setIdToEdit] = useState(0)

    useEffect(()=>{
        let product = products.find((p)=>p.id===idToEdit)
        if(product){
            label.current.value = product.label;
        price.current.value = product.price;
        imgURL.current.value = product.imgURL
        } else{
            label.current.value = ''
            price.current.value = 0
            imgURL.current.value = ''
        }
    }, [idToEdit, products])



    

    function handleSubmit(e){
        e.preventDefault(0)
        if(idToEdit===0){
            addProduct({label:label.current.value, price:price.current.value, imgURL:imgURL.current.value})
            label.current.value = ''
            price.current.value = 0
            imgURL.current.value = ''
        } else{
            updateProduct(idToEdit, {label:label.current.value, price:price.current.value, imgURL:imgURL.current.value})
            setIdToEdit(0)
        }

    }



    return(
        <div className="root-container">
            <form onSubmit={(e)=>handleSubmit(e)}>
            <input type="text"  ref={label} placeholder='Label' required/>
            <input type="number" ref={price} min={1} max={100000000} placeholder={0} required/>
            <input type="text" ref={imgURL} placeholder='Image URL' required/>
            <input type="submit" value={idToEdit===0?'Add':'Update'}/>
        </form>
        <List setIdToEdit={setIdToEdit} deleteProduct={deleteProduct} products={products}/>
        </div>

    )
}