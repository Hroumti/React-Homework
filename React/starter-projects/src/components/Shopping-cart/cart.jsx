import React, {useState, useRef} from 'react'

export default function Cart({cart, handleDelete}){
    return(
        <div className="cart-container">
            <table className='cart-table'>
                <thead>
                    <tr className='headers'>
                    <th>Label</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    {cart&&(cart.map(p=>(<tr key={p.id}>
                    <td>{p.label}</td>
                    <td>{p.price}$</td>
                    <td>{p.quantity}</td>
                    <td><button className='delete' data-id={p.id} onClick={()=>handleDelete(p.id)}>Delete</button></td>
                </tr>)))}
                </tbody>
            </table>
            <div className="total-container">Total:<span className='total'>{cart.reduce((acc, p)=>acc+(p.price*p.quantity), 0)}$</span></div>
        </div>
    )
}