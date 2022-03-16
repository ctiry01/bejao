import React from "react";
import styled from "styled-components";
import {FormCard} from "../components/molecules/FormCard";

export const Login = () => {
    return (
        <WrapperLogin>
            <FormCard/>
        </WrapperLogin>
    )
}

const WrapperLogin = styled.div`
    width: 100%;
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid green;
`
