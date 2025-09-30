import React, {useState, useRef, useEffect} from 'react'

export default function Form(){
    const [products, setProducts] = useState([])
    const [currId, setCurrId] = useState(0)
    const label = useRef('')
    const price = useRef(0)
    const imgURL = useRef('')
    const [idToUpdate, setIdToUpdate] = useState(0)

    useEffect(()=>{
        fetch(`http://localhost:3001/Products`)
        .then(res=>{
            if(!res.ok){
                throw new Error(`Failed to fetch`)
            }
            return res.json();
        })
        .then(data=>{
            setProducts(data)
            setIdToUpdate(data.length+1)
        }
        )
        .catch(err=>console.error("Data fetch error!!"))
    }, [])

    function handleSubmit(e){
        e.preventDefault(0)
        setProducts([...products, {id:currId, label:label.current.value, price:price.current.value, imgURL:imgURL.current.value}])
        setCurrId(currId+1)
        label.current.value = ''
        price.current.value = 0
        imgURL.current.value = ''

    }



    return(
        <form onSubmit={(e)=>handleSubmit(e)}>
            <input type="text"  ref={label} placeholder='Label' required/>
            <input type="number" ref={price} min={1} max={100000000} placeholder={0} required/>
            <input type="text" ref={imgURL} placeholder='Image URL' required/>
            <input type="submit" value="Add"/>
        </form>
    )
}