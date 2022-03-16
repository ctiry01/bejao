import React from 'react';
import ReactDOM from 'react-dom';


export default function HelloReact()
{
    return (
        <div>
            <h1>test from react</h1>
        </div>
    )
}

if (document.getElementById('hello-react')) {
console.log("test from component");
    ReactDOM.render(<HelloReact />, document.getElementById('hello-react'));
}
