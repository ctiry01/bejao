import React from "react";
import styled from "styled-components";

export const Separator = ({size = 1}) => {
    return (
        <WrapperSeparator size={size}/>
    )
}

const WrapperSeparator = styled.div`
    padding: ${({size}) => `${size}rem`} 0;
`
