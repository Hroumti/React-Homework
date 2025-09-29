import React, {useEffect, useState} from 'react'

export default function Table({users, handleDelete, handleModify}){
    return(
        <div className="cart-container">
            <table className='cart-table'>
                <thead>
                    <tr className='headers'>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    {users&&(users.map(u=>(<tr key={u.id}>
                    <td>{u.id}</td>
                    <td>{u.name}</td>
                    <td>{u.email}</td>
                    <td>
                        <button className='modify' data-id={u.id} onClick={()=>handleModify(u.id)}>Modify</button>
                        <button className='delete' data-id={u.id} onClick={()=>handleDelete(u.id)}>Delete</button>
                    </td>
                </tr>)))}
                </tbody>
            </table>
        </div>
    )
}