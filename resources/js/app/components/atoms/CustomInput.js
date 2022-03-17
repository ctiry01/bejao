import React, { forwardRef } from 'react'
import { BsCheckCircleFill } from 'react-icons/bs'

import styled from 'styled-components'

const TextInput = forwardRef(function FreeActivityPasswordForm(
    { placeholder, className, valid, ...other },
    ref
) {
    return (
        <Wrapper>
            <Input placeholder={placeholder} {...other} ref={ref} />
            {valid && <ValidIcon size="1.4rem" color="#72cc77" />}
        </Wrapper>
    )
})

const Wrapper = styled.div`
  width: 100%;
  position: relative;
`

const Input = styled.input`
  height: ${(props) => props.height || '50px'};
  border: none;
  border-bottom: 1px solid #AFAFAF;
  background-color: #F5F5F5;
  padding: 5px 0px 0px 10px;
  font-size: 0.9rem;
  width: 100%;
  color: #555;
  :focus {
    outline: none;
    border-bottom: 2px solid #5D93FD;
    color: black;
  }
`
const ValidIcon = styled(BsCheckCircleFill)`
  position: absolute;
  right: 10px;
  top: 15px;
`

export default TextInput
