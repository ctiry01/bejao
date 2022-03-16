import React from 'react';
import ReactDOM from 'react-dom';
import styled from 'styled-components';
import {Button} from "./components/atoms/Button";


export default function App() {
    return (
        <Wrapper>
            <Button>Click</Button>
        </Wrapper>
    )
}

const Wrapper = styled.div`
  border: 1px solid red;
`

if (document.getElementById('react-app')) {
    ReactDOM.render(<App/>, document.getElementById('react-app'));
}
