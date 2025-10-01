import React, {useContext} from "react";

export default function List({setIdToEdit, deleteProduct, products}){
    return(
        <div className="container">
            {products.map((p)=>(
                <div className="card" key={p.id}>
                    <img src={p.imgURL} alt={p.label} />
                    <div className="card-body">
                        <h5>{p.label}</h5>
                        <p>Price:{p.price} DH</p>
                        <div className="buttons">
                            <button className="edit" onClick={()=>{setIdToEdit(p.id)}}>Edit</button>
                            <button className="delete" onClick={()=>{deleteProduct(p.id)}}>Delete</button>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    )
}