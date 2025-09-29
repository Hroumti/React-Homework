import React, { useState, useEffect, useRef } from 'react'
import Table from './table.jsx'

export default function Form() {
    const [users, setUsers] = useState([])
    const [id, setId] = useState(0)
    const [modifyId, setModifyId] = useState(0)

    const nameRef = useRef(null)
    const emailRef = useRef(null)

    useEffect(() => {
        fetch('https://jsonplaceholder.typicode.com/users')
            .then(res => res.json())
            .then(data => {
                setUsers(data)
                setId(data.length + 1)
            })
            .catch(err => console.error(err));
    }, [])

    function handleSubmit(e) {
        e.preventDefault()

        const name = nameRef.current.value
        const email = emailRef.current.value

        if (name !== '' && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            if (modifyId === 0) {
                setUsers([...users, { id: id, name: name, email: email }])
                setId(id + 1)
            } else {
                setUsers(users.map(u => u.id === modifyId ? { ...u, name: name, email: email } : u))
                setModifyId(0)
            }
            
            nameRef.current.value = ''
            emailRef.current.value = ''
        } else {
            alert('Invalid input')
        }
    }

    function handleModify(i) {
        setModifyId(i)
        let modifyUser = users.find(u => u.id === i)
        
        if (modifyUser) {
            nameRef.current.value = modifyUser.name
            emailRef.current.value = modifyUser.email
        }
    }

    function handleDelete(i) {
        setUsers(users.filter(u => u.id !== i))
    }

    return (
        <div className="container">
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    className='input'
                    required
                    name='name'
                    ref={nameRef} 
                    placeholder='name'
                />
                <input
                    type="text"
                    className='input'
                    required
                    name='email'
                    ref={emailRef}
                    placeholder='email'
                />
                <input
                    type="submit"
                    className='submit'
                    value={modifyId === 0 ? 'Add' : 'Update'}
                />
            </form>
            <Table users={users} handleDelete={handleDelete} handleModify={handleModify}></Table>
        </div>
    )
}