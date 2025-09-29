import React, {useState, useRef} from 'react'
import { v4 as uuidv4 } from 'uuid';
import Cart from './cart'

export default function Form(){
    const label = useRef('')
    const price = useRef(0)
    const quantity = useRef(0)
    const [cart, setCart] = useState([])

    function handleSubmit(e){
        e.preventDefault()
        if(label.current.value.trim()!==''&&price.current.value>0&&quantity.current.value>0){
            setCart([...cart, {id:uuidv4(), label:label.current.value, price:price.current.value, quantity:quantity.current.value}])
            label.current.value = ''
            price.current.value = null
            quantity.current.value = null
        } else{
            alert('Invalid input!!!')
        }
    }

    function handleDelete(id){
        setCart(cart.filter(p=>p.id!==id))
    }

    return(
        <div className="container">
            <form onSubmit={(e)=>handleSubmit(e)}>
                <input type="text" className='input' required name='label' ref={label} placeholder='Label'/>
                <input type="number" className='input' required name='price' ref={price} placeholder='Price' min='1' max='10000' step='0.5'/>
                <input type="number" className='input' required name="quantity" ref={quantity} placeholder='Quantity' min='1' max='1000' step='1'/>
                <input type="submit" className='submit' value='submit' />

            </form>
            <Cart cart={cart} handleDelete={handleDelete}></Cart>
        </div>
    )
}