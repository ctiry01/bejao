import React, {useState} from "react";
import styled from "styled-components";
import {CustomButton} from "../atoms/CustomButton";
import CustomInput from "../atoms/CustomInput";
import {login} from "../../api/user";
import {UserLogin, useUserDispatcher, useUserState} from "../../context/userContext";


export const FormCard = () => {
    const [email, setEmail] = useState();
    const [password, setPassword] = useState();

    const userContextState = useUserState();
    const userContextDispatcher = useUserDispatcher();

    console.log(userContextState)

    const onSubmmit = () => {
        UserLogin(email, password)
            .then((r) => {
                userContextDispatcher(r)
            }).catch((e) => {
            console.log('error')
        })
    }


    
    return (
        <Wrapper>
            <h1>Login</h1>
            <CustomInput placeholder={'email'} onChange={(e) => setEmail(e.target.value)}/>
            <Separator/>
            <CustomInput placeholder={'password'} type={'password'} onChange={(e) => setPassword(e.target.value)}/>
            <Separator/>
            <CustomButton onClick={onSubmmit} disabled={!email && !password}>Login</CustomButton>
        </Wrapper>
    )
}

const Wrapper = styled.div`
    padding: 2rem;
    box-shadow: rgb(214 219 232) 5px 5px 15px 5px;
    border-radius: 16px;
    background-color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
`

const Separator = styled.div`
    padding: 1rem 0;
`
