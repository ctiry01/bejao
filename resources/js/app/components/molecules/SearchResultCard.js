import React from "react";
import styled from "styled-components";
import {CgProfile} from "react-icons/cg";
import {AiFillCar} from "react-icons/ai";
import {GiJourney} from "react-icons/gi";
import {Separator} from "../atoms/Separator";


export const SearchResultCard = ({brand, model, seats, fuelCons, name, email, journeys}) => {

    return (
        <Wrapper>
            <AiFillCar/>
            <span><b>Marca:</b> {brand}</span>
            <span><b>Modelo:</b> {model}</span>
            <span><b>Número de plazas:</b> {seats}</span>
            <span><b>Consumo:</b> {fuelCons}</span>
            <Separator size={'0.2'}/>
            <CgProfile/>
            <span><b>Nombre:</b> {name}</span>
            <span><b>Email:</b> {email}</span>
            {journeys && journeys.length > 0 && journeys.map((j) => {
                return (
                    <WrapperJourneys key={j.key}>
                        <Separator size={'0.2'}/>
                        <GiJourney/>
                        <span><b>Trayecto:</b> {j.name}</span>
                        <span><b>Origen:</b> {j.origin_address}</span>
                        <span><b>Destino:</b> {j.destination_address}</span>
                        <span><b>Hora:</b> {j.time}</span>
                    </WrapperJourneys>
                )
            })}
        </Wrapper>
    )
}

const Wrapper = styled.div`
    padding: 0.8rem;
    margin: 0.6rem;
    display: flex;
    flex-direction: column;
    border: 1px solid grey;
    border-radius: 8px;
    width: 100%;

    > span {
        font-size: 0.6rem;
        padding: 0.1rem 0;
    }
`

const WrapperJourneys = styled.div`
    display: flex;
    align-items: center;
    margin-top: 0.4rem;
    flex: 1;

    > span {
        font-size: 0.6rem;
        padding: 0.1rem;
    }

`
