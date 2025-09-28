import React, {useState, useRef} from 'react'
import { v4 as uuidv4 } from 'uuid';

export default function Country2(){
    const [country, setCountry] = useState('')
    const [capital, setCapital] = useState('')
    const [flagURL, setFlagURL] = useState('')
    const [modifyState, setModifyState] = useState(0)
    const [countries, setCountries] = useState([])
    function handleSubmit(e){
        e.preventDefault()
        if(!/^[A-Za-z\s-]{3,50}$/.test(country)||!/^[A-Za-z\s-]{3,50}$/.test(capital)||!/^(http|https):\/\/[^\s$.?#].[^\s]*$/.test(flagURL)){
            alert('INVALID INPUT!!!')
            return
        } else if(modifyState){
            setCountries(countries.map((c)=>c.id===modifyState?{...c, country, capital, flagURL}:c))
            setModifyState(0)

        } else{
            setCountries([...countries, {id:uuidv4(), country, capital, flagURL}])
        }
        setCountry('')
        setCapital('')
        setFlagURL('')
    }
    function handleModify(e){
        let idToModify = e.target.dataset.id
        setModifyState(idToModify)
        let c= countries.find((c)=>c.id===idToModify)
        setCountry(c.country)
        setCapital(c.capital)
        setFlagURL(c.flagURL)
    }

    function handleDelete(e){
        let idToDelete = e.target.dataset.id
        setCountries(countries.filter((c)=>c.id!==idToDelete))
    }

    return(
        <>
            <div className="main-container">
                <form onSubmit={(e)=>handleSubmit(e)}>
                <input type="text" placeholder='Country' value={country} onChange={(e)=>setCountry(e.target.value)} required/>
                <input type="text" placeholder='Capital' value={capital} onChange={(e)=>setCapital(e.target.value)} required/>
                <input type="text" placeholder='Flag' value={flagURL} onChange={(e)=>setFlagURL(e.target.value)} required/> 
                <input type="submit" value={modifyState!==0?'Update':'Add'}/>
            </form>
            <h1>Countries</h1>
            <div className="render-container">
                

                {countries&&(countries.map((c)=>(
                    <div className="card" key={c.id}>
                        <img src={c.flagURL} alt={c.country} />
                        <h2>{c.country}</h2>
                        <h3>{c.capital}</h3>
                        <span className="actions">
                            <button className="modify" data-id={c.id} onClick={(e)=>handleModify(e)}>Modify</button>
                            <button className="delete" data-id={c.id} onClick={(e)=>handleDelete(e)}>Delete</button>

                        </span>
                    </div>
                )))}
            </div>
            </div>
        </>
    )
}