import React, { useEffect, useState, ReactElement } from 'react'
import styled from 'styled-components'
import { CgClose } from 'react-icons/cg'

export const Modal = ({
                          children,
                          className,
                          showModal = false,
                          blocker = false,
                          overlay,
                          shadow,
                          width = '400px',
                          onClose = () => {},
                          showHeader = true,
                      }) => {
    const [show, setShow] = useState(showModal)
    const closeModal = () => {
        setShow(false)
    }

    useEffect(() => {
        setShow(showModal)
    }, [showModal])

    useEffect(() => {
        if (!show) onClose()
    }, [show])

    const clickContainer = (ev) => {
        ev.stopPropagation()
    }

    return (
        <>
            {show && (
                <>
                    <Overlay overlay={overlay} />
                    <Wrapper onClick={blocker ? () => {} : closeModal}>
                        <Container
                            className={className}
                            onClick={clickContainer}
                            shadow={shadow}
                            width={width}
                        >
                            {showHeader && (
                                <Header>
                                    <CloseIcon size={25} onClick={closeModal} />
                                </Header>
                            )}
                            {children}
                        </Container>
                    </Wrapper>
                </>
            )}
        </>
    )
}

const Wrapper = styled.div`
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  z-index: 101;
  top: 0;
  left: 0;
`

const Container = styled.div`
  width: 100%;
  max-width: ${({ width }) => width};
  overflow: auto;
  max-height: 100%;
  border-radius: 10px;
  background-color: white;
  opacity: 1;
  z-index: 101;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: ${(props) => props.shadow && '4px 3px 29px -8px rgba(0, 0, 0, 0.75)'};
`

const Overlay = styled.div`
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background-color: ${(props) => props.overlay && 'black'};
  opacity: ${(props) => props.overlay && 0.3};
  z-index: 100;
`

const Header = styled.div`
  padding: 1rem 1rem 0 1rem;
  width: 100%;
  text-align: right;
`

const CloseIcon = styled(CgClose)`
  cursor: pointer;
`
