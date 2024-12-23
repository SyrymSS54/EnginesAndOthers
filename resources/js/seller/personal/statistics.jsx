
import { useEffect, useState } from 'react';
import { BarChart, Bar, Rectangle, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

const data = [
  {
    name: 'Page A',
    uv: 4000,
    pv: 2400,
    amt: 2400,
  },
  {
    name: 'Page B',
    uv: 3000,
    pv: 1398,
    amt: 2210,
  },
  {
    name: 'Page C',
    uv: 2000,
    pv: 9800,
    amt: 2290,
  },
  {
    name: 'Page D',
    uv: 2780,
    pv: 3908,
    amt: 2000,
  },
  {
    name: 'Page E',
    uv: 1890,
    pv: 4800,
    amt: 2181,
  },
  {
    name: 'Page F',
    uv: 2390,
    pv: 3800,
    amt: 2500,
  },
  {
    name: 'Page G',
    uv: 3490,
    pv: 4300,
    amt: 2100,
  },
];

export default function Statistics() {

    const [store,setStore] = useState({});
    const [statistics,setStatistics] = useState([])

    const getStore = async() => {
      const data = await  fetch("/seller/store", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
      .then(response => {
        return response.json();
      })
      .then(data => {
        console.log(data)
        return data; 
      })
      .catch(error => {
        console.error('Error:', error); 
      })

      console.log(data)
      setStore(data.map((item,index)=>{
        return {name:item.name,
          Приход:item.records.reduce((acc,val)=>val.oper=="Приход"? acc + val.count: acc,0),
          Продажа:item.records.reduce((acc,val)=>val.oper=="Расход"? acc + val.count: acc,0),
          ВНаличии:item.count
        }
      }))
    }

    const getStatistics = async() => {
      const data = await  fetch("/statistics", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
      .then(response => {
        return response.json();
      })
      .then(data => {
        console.log(data)
        return data; 
      })
      .catch(error => {
        console.error('Error:', error); 
      })
    }

    useEffect(()=>{getStore();getStatistics()},[])
  
    return (
      <div className='app-container'>
      <ResponsiveContainer width="100%" height={400}>
        <br/>
        <BarChart
          width={500}
          height={300}
          data={store}
          margin={{
            top: 5,
            right: 30,
            left: 20,
            bottom: 5,
          }}
        >
          <CartesianGrid strokeDasharray="3 3" />
          <XAxis dataKey="name" />
          <YAxis />
          <Tooltip />
          <Legend />
          <Bar dataKey="Продажа" fill="#8884d8" activeBar={<Rectangle fill="pink" stroke="blue" />} />
          <Bar dataKey="Приход" fill="#82ca9d" activeBar={<Rectangle fill="gold" stroke="purple" />} />
          <Bar dataKey="ВНаличии" fill="#84dde3" activeBar={<Rectangle fill="#d46c31" stroke="purple" />} />

        </BarChart>
      </ResponsiveContainer>
      <br></br>
      </div>
    );
  }

