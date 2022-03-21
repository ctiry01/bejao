import React, {useEffect, useState} from "react";
import styled from "styled-components";
import {CustomButton} from "../atoms/CustomButton";
import CustomInput from "../atoms/CustomInput";
import {UserLogin, useUserDispatcher, useUserState} from "../../context/userContext";
import {Link, useNavigate} from "react-router-dom";
import {Loading} from "../atoms/Loading";
import {Card} from "../atoms/Card";
import {Separator} from "../atoms/Separator";


export const LoginFormCard = () => {
    const [email, setEmail] = useState();
    const [password, setPassword] = useState();
    const [loading, setLoading] = useState(false);
    const userContextDispatcher = useUserDispatcher();
    const navigate = useNavigate();

    const onSubmmit = () => {
        setLoading(true)
        UserLogin(email, password)
            .then((r) => {
                userContextDispatcher(r)
                setLoading(false)
                navigate('/home', {replace: true})
            }).catch((e) => {
            console.log('error')
            setLoading(false)
        })
    }

    if (loading) {
        return (
            <Loading/>
        )
    }

    return (
        <Card>
            <h1>Acceder a tu cuenta</h1>
            <CustomInput placeholder={'email'} onChange={(e) => setEmail(e.target.value)} label={'email'}/>
            <Separator/>
            <CustomInput placeholder={'password'} type={'password'} onChange={(e) => setPassword(e.target.value)} label={'password'}/>
            <p>¿No tienes cuenta? <Link to="/register">Regístrate</Link></p>
            <Separator/>
            <CustomButton onClick={onSubmmit} disabled={!email && !password}>Acceder</CustomButton>
        </Card>
    )
}
