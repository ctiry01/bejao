import React from "react";
import styled from "styled-components";

export const Card = ({children}) => {
    return (
        <Wrapper>
            {children}
        </Wrapper>
    )
}

const Wrapper = styled.div`
    padding: 2rem;
    width: 100%;
    max-width: 380px;
    box-shadow: rgb(214 219 232) 5px 5px 15px 5px;
    border-radius: 16px;
    background-color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
`
