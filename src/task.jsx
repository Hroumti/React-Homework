import React, {useState} from "react";

function Task(){
    const [task, setTask] = useState('')
    const [tasks, setTasks] = useState([])

    const addTask=() =>{
        if(task.trim()!==''){
            setTasks([...tasks, task])
            setTask('')
        }
    }
    const deleteTask=(index)=>{
        setTasks(tasks.filter((t,i)=>i!==index))
    }
    return(
        <div>
            <div className="input-group"><input type="text" value={task} onChange={(e)=>setTask(e.target.value)}/>
            <button className="add" onClick={addTask}>Add task</button></div>
            <div className="tasks">
                {tasks&&(tasks.map((t, index)=><li>{t} <button className="delete" onClick={()=> deleteTask(index)}>Delete</button></li>))}
            </div>
        </div>
    )
}

export default Task