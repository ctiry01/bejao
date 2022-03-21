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
    const [originAddress, setOriginAddress] = useState();
    const [destinationAddress, setDestinationAddress] = useState();
    const [brand, setBrand] = useState();
    const [model, setModel] = useState();
    const [seats, setSeats] = useState();
    const [consumption, setConsumption] = useState();

    const [loading, setLoading] = useState(false);
    const userContextDispatcher = useUserDispatcher();
    const navigate = useNavigate();

    const onSubmmit = () => {
        setLoading(true)
        UserRegister(name, email, password, originAddress, destinationAddress, brand, model, seats, consumption)
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
            <CustomInput placeholder={'nombre'} onChange={(e) => setName(e.target.value)} label={'nombre'}/>
            <Separator/>
            <CustomInput placeholder={'email'} onChange={(e) => setEmail(e.target.value)} label={'email'}/>
            <Separator/>
            <CustomInput placeholder={'password'} type={'password'} onChange={(e) => setPassword(e.target.value)} label={'password'}/>
            <Separator/>
            <CustomInput placeholder={'origin address'} onChange={(e) => setOriginAddress(e.target.value)} label={'origin address'}/>
            <Separator/>
            <CustomInput placeholder={'destination address'} onChange={(e) => setDestinationAddress(e.target.value)} label={'destination address'}/>
            <Separator/>
            <p>¿Quieres dar de alta tu vehículo? (opcional)</p>
            <Separator/>
            <CustomInput placeholder={'marca'} onChange={(e) => setBrand(e.target.value)} label={'marca'}/>
            <Separator/>
            <CustomInput placeholder={'modelo'} onChange={(e) => setModel(e.target.value)} label={'modelo'}/>
            <Separator/>
            <CustomInput placeholder={'asientos'} onChange={(e) => setSeats(e.target.value)} label={'asientos'}/>
            <Separator/>
            <CustomInput placeholder={'consumo'} onChange={(e) => setConsumption(e.target.value)} label={'consumo'}/>
            <Separator/>
            <Separator/>
            <p>¿Tienes una cuenta? <Link to="/">Acceder</Link></p>
            <Separator/>
            <CustomButton onClick={onSubmmit} disabled={!email && !password}>Login</CustomButton>
        </Card>
    )
}

