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
    const [origin, setOrigin] = useState();
    const [destination, setDestination] = useState();
    const [showModal, setShowModal] = useState(false);

    const userContextDispatcher = useUserDispatcher();
    const userContextState = useUserState();

    const onSubmmit = () => {
        RequestVehicle(origin, destination)
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

                <WrapperInfoTrip>
                    <p><b>Origen:</b> {userContextState.userData.user.origin_address}</p>
                    <p><b>Destino:</b> {userContextState.userData.user.destination_address}</p>
                </WrapperInfoTrip>
                <Separator/>
                <CustomInput placeholder={'Ciudad origen'} label={'Ciudad origen'}
                             onChange={(e) => setOrigin(e.target.value)}/>
                <Separator/>
                <CustomInput placeholder={'Ciudad destino'} label={'Ciudad destino'}
                             onChange={(e) => setDestination(e.target.value)}/>
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
                                    brand={res.brand}
                                    fuelCons={res.fuel_consumption}
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

const WrapperInfoTrip = styled.div`
    > p {
        margin: 0;
    }
`


const Title = styled.h2`
    margin-top: 0;
    text-align: center;
`

const WrapperResult = styled.div`
    display: flex;
`

