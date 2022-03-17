import React, {useState} from "react";
import styled from "styled-components";
import {CustomButton} from "../atoms/CustomButton";
import CustomInput from "../atoms/CustomInput";
import {UserRegister, useUserDispatcher} from "../../context/userContext";
import {Link, useNavigate} from "react-router-dom";
import {Loading} from "../atoms/Loading";
import {Card} from "../atoms/Card";
import {Separator} from "../atoms/Separator";

export const RegisterFormCard = () => {
    const [name, setName] = useState();
    const [email, setEmail] = useState();
    const [password, setPassword] = useState();
    const [loading, setLoading] = useState(false);
    const userContextDispatcher = useUserDispatcher();
    const navigate = useNavigate();

    const onSubmmit = () => {
        setLoading(true)
        UserRegister(name, email, password)
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
            <h1>Regístrate</h1>
            <CustomInput placeholder={'nombre'} onChange={(e) => setName(e.target.value)}/>
            <Separator/>
            <CustomInput placeholder={'email'} onChange={(e) => setEmail(e.target.value)}/>
            <Separator/>
            <CustomInput placeholder={'password'} type={'password'} onChange={(e) => setPassword(e.target.value)}/>
            <p>¿Tienes una cuenta? <Link to="/">Acceder</Link></p>
            <Separator/>
            <CustomButton onClick={onSubmmit} disabled={!email && !password}>Login</CustomButton>
        </Card>
    )
}

