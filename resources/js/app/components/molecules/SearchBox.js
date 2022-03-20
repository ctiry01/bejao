import React, {useState} from "react";
import styled from "styled-components";
import {CustomButton} from "../atoms/CustomButton";
import CustomInput from "../atoms/CustomInput";
import {RequestVehicle, useUserDispatcher, useUserState} from "../../context/userContext";
import {Card} from "../atoms/Card";
import {Separator} from "../atoms/Separator";
import {Modal} from "./Modal";
import {SearchResultCard} from "./SearchResultCard";


export const SearchBox = () => {
    const [seats, setSeats] = useState(1);
    const [origin, setOrigin] = useState();
    const [destination, setDestination] = useState();
    const [showModal, setShowModal] = useState(false);

    const userContextDispatcher = useUserDispatcher();
    const userContextState = useUserState();

    console.log(userContextState)

    const onSubmmit = () => {
        RequestVehicle(seats, origin, destination)
            .then((r) => {
                userContextDispatcher(r)
                setShowModal(true)
            }).catch((e) => {
            console.log('error')
            console.log(JSON.parse(e))

        })
    }

    return (
        <>
            <Card>
                <Title>Encuentra un coche para compartir</Title>
                <CustomInput placeholder={'Número de pasajeros'} label={'Número de pasajeros'} value={seats} type={'number'}
                             onChange={(e) => setSeats(e.target.value)}/>
                <Separator/>
                <CustomInput placeholder={'Ciudad origen'} label={'Ciudad origen'} onChange={(e) => setOrigin(e.target.value)}/>
                <Separator/>
                <CustomInput placeholder={'Ciudad destino'} label={'Ciudad destino'} onChange={(e) => setDestination(e.target.value)}/>
                <Separator/>
                <CustomButton onClick={onSubmmit}>Buscar</CustomButton>
            </Card>
            <Modal width="500px" showModal={showModal} onClose={() => setShowModal(false)} shadow overlay>
                {
                    userContextState.resultData && userContextState.resultData.length > 0 &&
                    userContextState.resultData.map((res) => {
                        return (
                            <WrapperResult key={res.key}>
                                <SearchResultCard
                                    seats={res.seats}
                                    model={res.model}
                                    fuelCons={res.fuel_consumption}
                                    engine={res.engine}
                                    brand={res.brand}
                                    name={res.user.name}
                                    email={res.user.email}
                                />
                            </WrapperResult>
                        )
                    })
                }
                {userContextState.resultData && userContextState.resultData.length <= 0 &&
                    <p>no hay resultados</p>
                }
            </Modal>
        </>
    )
}

const Title = styled.h2`
    margin-top: 0;
    text-align: center;
`

const WrapperResult = styled.div`
    display: flex;
`

